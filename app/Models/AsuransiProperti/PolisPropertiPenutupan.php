<?php

namespace App\Models\AsuransiProperti;

use Exception;
use App\Models\Model;
use App\Models\Auth\User;
use Illuminate\Support\Carbon;
use App\Models\Master\Geo\City;
use App\Models\Traits\HasFiles;
use App\Models\Master\Geo\District;
use App\Models\Master\Geo\Province;
use App\Models\Traits\HasApprovals;
use App\Models\AsuransiProperti\PolisProperti;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\AsuransiProperti\PolisPropertiCek;
use App\Models\AsuransiProperti\PolisPropertiNilai;
use App\Models\AsuransiProperti\PolisPropertiPayment;
use App\Models\Master\AsuransiProperti\AsuransiProperti;
use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;

class PolisPropertiPenutupan extends Model
{
    use HasApprovals;
    use HasFiles;

    protected $table = 'trans_polis_properti_penutupan';

    protected $fillable = [
        'polis_id',
        'province_id',
        'city_id',
        'district_id',
        'okupasi_id',
        'village',
        'alamat',
        'kode_pos',
        'tahun_bangunan',
        'nilai_bangunan',
        'nilai_isi',
        'perlindungan_id',
        'konstruksi_id',
        'letak_resiko',
        'tanggal_awal',
        'tanggal_akhir',
        'nilai_pondasi',
        'nilai_galian',
        'nilai_peralatan',
        'nilai_stok',
        'nilai_lainnya',
        'tinggi_bangunan',
        'tinggi_menara',
        'tahun_pembuatan',
        'pengajuan_tertolak',
        'alasan_tertolak',
        'status',
    ];

    protected $dates = [
        'tanggal_awal',
        'tanggal_akhir',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

    public function setTanggalAwalAttribute($value)
    {
        $this->attributes['tanggal_awal'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setTanggalAkhirAttribute($value)
    {
        $this->attributes['tanggal_akhir'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    /*******************************
     ** ACCESSOR
     *******************************/

    public static function generateNoAsuransi()
    {
        $currentDate = date('Ymd');
        
        $lastNumber = static::whereYear('created_at', now()->format('Y'))->max('no_max');
        
        if ($lastNumber !== null) {
            $newNumberInt = intval($lastNumber) + 1;
            $newNumberFormatted = str_pad($newNumberInt, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumberFormatted = '001';
        }
       

        $generatedNumber = $currentDate . $newNumberFormatted;
        return json_decode(
            json_encode(
                [
                    'no_asuransi' => $generatedNumber,
                    'no_max' => $newNumberFormatted,
                    'no_last' => $lastNumber,
                ]
            )
        );
    }

    public function getNewNo()
    {
        if ($this->letter_no) {
            return $this->letter_no;
        }
        $max = static::whereYear('created_at', now()->format('Y'))
            ->max('no_max');

        return $max ? $max + 1 : 1;
    }

    /*******************************
     ** RELATION
     *******************************/
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function okupasi()
    {
        return $this->belongsTo(Okupasi::class, 'okupasi_id');
    }

    public function perlindungan()
    {
        return $this->belongsTo(PerlindunganProperti::class, 'perlindungan_id');
    }

    public function konstruksi()
    {
        return $this->belongsTo(KonstruksiProperti::class, 'konstruksi_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function polis()
    {
        return $this->belongsTo(PolisProperti::class, 'polis_id');
    }
    /*******************************
     ** SCOPE
     *******************************/

    public function scopeGrid($query)
    {
        return $query->latest();
    }

    public function scopePolisPropertiGrid($query)
    {
        return $query->where('status', 'completed')->latest();
    }

    public function scopeFilters($query)
    {
        return $query->filterBy(['id_purchase_order'])
            ->when($id = request()->post('id'), function ($qq) use ($id) {
                $qq->where('id_purchase_order', $id);
            })
            ->when(
                $date_start = request()->post('date_start'),
                function ($qq) use ($date_start) {
                    $date_start = Carbon::createFromFormat('d/m/Y', $date_start);
                    $qq->where('tanggal', '>=', $date_start);
                }
            )
            ->when(
                $date_end = request()->post('date_end'),
                function ($qq) use ($date_end) {
                    $date_end = Carbon::createFromFormat('d/m/Y', $date_end);
                    $qq->where('tanggal', '<=', $date_end);
                }
            )
            ->when(
                $vendor_id = request()->post('vendor_id'),
                function ($qq) use ($vendor_id) {
                    $qq->where('vendor_id', $vendor_id);
                }
            );
    }

    /*******************************
     ** SAVING
     *******************************/

    public function handleStoreOrUpdate($request)
    {
        $this->beginTransaction();
        try {
            $this->fill($request->all());
            $this->status = 'draft';
            $this->save();
            $this->saveLogNotify();

            $redirect = route(request()->get('routes') . '.index');

            return $this->commitSaved();
        } catch (Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function handleDestroy()
    {
        $this->beginTransaction();
        try {
            $this->saveLogNotify();
            $this->delete();

            return $this->commitDeleted();
        } catch (\Exception $e) {
            return $this->rollbackDeleted($e);
        }
    }

    public function handleSubmitSave($request)
    {
        $this->beginTransaction();
        try {
            $menu = \App\Models\Setting\Globals\Menu::where('module', 'asuransi.polis-properti-penutupan')->first();
            
            if(!empty($this->status) && $this->status == 'pending'){
                if ($request->is_submit == 1) {
                    if ($menu->flows()->get()->groupBy('order')->count() == null) {
                        return $this->rollback(
                            [
                                'message' => 'Belum Ada Alur Persetujuan!'
                            ]
                        );
                    }
                    $this->generateApproval($request->module);
                }
                $this->status = $request->is_submit ? 'waiting.approval' : 'pending';
                $this->save();

                $this->saveFilesByTemp($request->bukti_pembayaran, $request->module, 'bukti_pembayaran');

                $detailPayment = $this->detailPayment()->firstOrNew([
                    'polis_id' => $this->id,
                ]);
                $detailPayment->bank = $request->bank;
                $detailPayment->no_rekening = $request->no_rekening;
                $detailPayment->save();
            }
            else{
                if ($request->is_submit == 1) {
                    if ($menu->flows()->get()->groupBy('order')->count() == null) {
                        return $this->rollback(
                            [
                                'message' => 'Belum Ada Alur Persetujuan!'
                            ]
                        );
                    }
                    $this->generateApproval($request->module);
                }
                // $this->saveFiles($request);
                $this->status = $request->is_submit ? 'penawaran' : 'draft';
                $this->save();

                // Pengecekan Mobil
                $detailCek = $this->detailCek()->firstOrNew([
                    'polis_id' => $this->id,
                ]);
                $detailCek->province_id = $request->province_id;
                $detailCek->city_id = $request->city_id;
                $detailCek->district_id = $request->district_id;
                $detailCek->village = $request->village;
                $detailCek->alamat = $request->alamat;
                $detailCek->okupasi_id = $request->okupasi_id;
                $detailCek->status_lantai = $request->status_lantai;
                $detailCek->status_bangunan = $request->status_bangunan;
                $detailCek->status_banjir = $request->status_banjir;
                $detailCek->status_klaim = $request->status_klaim;
                $detailCek->save();

                $detailNilai = $this->detailNilai()->firstOrNew([
                    'polis_id' => $this->id,
                ]);
                $detailNilai->nilai_bangunan = str_replace(',', '', $request->nilai_bangunan);
                $detailNilai->nilai_isi =  str_replace(',', '', $request->nilai_isi);
                $detailNilai->nilai_mesin = str_replace(',', '', $request->nilai_mesin);
                $detailNilai->nilai_stok = str_replace(',', '', $request->nilai_stok);
                $detailNilai->nilai_pertanggungan = str_replace(',', '', $request->nilai_pertanggungan);
                $detailNilai->tanggal_awal = $request->tanggal_awal;
                $detailNilai->tanggal_akhir = $request->tanggal_akhir;
                $detailNilai->save();
            }
                
            $this->saveLogNotify();

            $redirect = route(request()->get('routes') . '.index');
            return $this->commitSaved(compact('redirect'));
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function saveFiles($request)
    {
        $this->saveFilesByTemp($request->ktp, $request->module, 'ktp');
        $this->saveFilesByTemp($request->stnk, $request->module, 'stnk');
        $this->saveFilesByTemp($request->bstk, $request->module, 'bstk');
        $this->saveFilesByTemp($request->foto_nomor_mesin, $request->module, 'foto_nomor_mesin');
        $this->saveFilesByTemp($request->foto_nomor_rangka, $request->module, 'foto_nomor_rangka');
        $this->saveFilesByTemp($request->mobil_tampak_depan, $request->module, 'mobil_tampak_depan');
        $this->saveFilesByTemp($request->mobil_tampak_kanan, $request->module, 'mobil_tampak_kanan');
        $this->saveFilesByTemp($request->mobil_tampak_kiri, $request->module, 'mobil_tampak_kiri');
        $this->saveFilesByTemp($request->mobil_tampak_belakang, $request->module, 'mobil_tampak_belakang');
        $this->saveFilesByTemp($request->dashboard_mobil, $request->module, 'dashboard_mobil');
    }

    public function handleReject($request)
    {
        $this->beginTransaction();
        try {
            $this->rejectApproval($request->module, $request->note);
            $this->update(['status' => 'rejected']);
            $this->saveLogNotify();

            $redirect = route(request()->get('routes') . '.index');
            return $this->commitSaved(compact('redirect'));
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function handleApprove($request)
    {
        $this->beginTransaction();
        try {
            $this->approveApproval($request->module);
            if ($this->firstNewApproval($request->module)) {
                $this->update(['status' => 'waiting.approval']);
            } else {
                if(!empty($this->status) && $this->status == 'penawaran'){
                    $this->update(['status' => 'pending']);
                }
                elseif(!empty($this->status) && $this->status == 'waiting.approval'){
                    $this->update(['status' => 'completed']);
                }
            }
            $this->saveLogNotify();

            $redirect = route(request()->get('routes') . '.index');
            return $this->commitSaved(compact('redirect'));
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function saveLogNotify()
    {
        $data = 'Data Polis Properti dengan No Asuransi ' . $this->no_asuransi;
        $routes = request()->get('routes');
        switch (request()->route()->getName()) {
            case $routes . '.store':
                $this->addLog('Membuat ' . $data);
                break;
            case $routes . '.update':
                $this->addLog('Mengubah ' . $data);
                break;
            case $routes . '.destroy':
                $this->addLog('Menghapus ' . $data);
                break;
            case $routes . '.submitSave':
                $this->addLog('Submit ' . $data);
                $this->addNotify([
                    'message' => 'Waiting Approval ' . $data,
                    'url' => route($routes . '.approval', $this->id),
                    'user_ids' => $this->getNewUserIdsApproval(request()->get('module')),
                ]);
                break;
            case $routes . '.approve':
                $this->addLog('Menyetujui ' . $data);
                $this->addNotify([
                    'message' => 'Waiting Approval ' . $data,
                    'url' => route($routes . '.approval', $this->id),
                    'user_ids' => $this->getNewUserIdsApproval(request()->get('module')),
                ]);
                break;
            case $routes . '.reject':
                $this->addLog('Menolak ' . $data . ' dengan alasan: ' . request()->get('note'));
                break;
        }
    }

    /*******************************
     ** OTHER FUNCTIONS
     *******************************/

    public function checkAction($action, $perms, $summary = null)
    {
        $user = auth()->user();

        switch ($action) {
            case 'create':
                return $user->checkPerms($perms . '.view');
                break;

            case 'show':
            case 'history':
                return $user->checkPerms($perms . '.view');
                break;

            case 'edit':
                $checkStatus = in_array($this->status, ['new', 'draft', 'rejected', 'pending']);
                return $checkStatus && $user->checkPerms($perms . '.edit');
                break;

            case 'delete':
                $checkStatus = in_array($this->status, ['new', 'draft', 'rejected']);
                return $checkStatus && $user->checkPerms($perms . '.delete');
                break;

            case 'approval':
                if ($this->checkApproval(request()->get('module'))) {
                    $checkStatus = in_array($this->status, ['waiting.approval', 'penawaran']);
                    return $checkStatus && $user->checkPerms($perms . '.approve');
                }
                break;

            case 'tracking':
                $checkStatus = in_array($this->status, ['waiting.approval', 'completed']);
                return $checkStatus && $user->checkPerms($perms . '.view');
                break;

            case 'print':
                $checkStatus = in_array($this->status, ['waiting.approval', 'completed']);
                return $checkStatus && $user->checkPerms($perms . '.view');
                break;

            default:
                return false;
                break;
        }
    }

    public function canDeleted()
    {
        if($this->detailCek()->exists()) return false;
        return true;
    }
}
