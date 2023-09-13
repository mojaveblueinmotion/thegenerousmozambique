<?php

namespace App\Models\AsuransiPerjalanan;

use Exception;
use App\Models\Model;
use App\Models\Auth\User;
use Illuminate\Support\Carbon;
use App\Models\Master\Geo\City;
use App\Models\Traits\HasFiles;
use App\Models\Master\Geo\District;
use App\Models\Master\Geo\Province;
use App\Models\Traits\HasApprovals;
use App\Models\Asuransi\PolisMobilCek;
use App\Models\Asuransi\PolisMobilNilai;
use App\Models\Asuransi\PolisMobilClient;
use App\Models\Asuransi\PolisMobilPayment;
use App\Models\AsuransiPerjalanan\PolisPerjalananPayment;
use App\Models\Master\AsuransiPerjalanan\AsuransiPerjalanan;

class PolisPerjalanan extends Model
{
    use HasApprovals;
    use HasFiles;

    protected $table = 'trans_polis_perjalanan';

    protected $fillable = [
        'no_asuransi',
        'no_max',
        'tanggal',
        'agent_id',
        'user_id',
        'asuransi_id',
        'name',
        'phone',
        'email',
        'province_id',
        'city_id',
        'district_id',
        'village',
        'alamat',
        'tanggal_lahir',
        'nik',
        'pekerjaan',
        'tanggal_awal',
        'tanggal_akhir',

        'from_province_id',
        'from_city_id',
        'destination_province_id',
        'destination_city_id',
        'ahli_waris',
        'hubungan_ahli_waris',
        'catatan',
        'status',
    ];

    protected $dates = [
        'tanggal',
        'tanggal_lahir',
        'tanggal_awal',
        'tanggal_akhir',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $value);
    }

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
    
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function asuransi()
    {
        return $this->belongsTo(AsuransiPerjalanan::class, 'asuransi_id');
    }

    public function detailPayment()
    {
        return $this->hasOne(PolisPerjalananPayment::class, 'polis_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function fromProvince()
    {
        return $this->belongsTo(Province::class, 'from_province_id');
    }

    public function fromCity()
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }
    
    public function destinationProvince()
    {
        return $this->belongsTo(Province::class, 'destination_province_id');
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }


    /*******************************
     ** SCOPE
     *******************************/

    public function scopeGrid($query)
    {
        return $query->latest();
    }

    public function scopePolisMobilGrid($query)
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
            $menu = \App\Models\Setting\Globals\Menu::where('module', 'asuransi.polis-perjalanan')->first();
            
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
                $this->saveFilesByTemp($request->ktp, $request->module, 'ktp');
                $this->fill($request->all());
                $this->status = $request->is_submit ? 'penawaran' : 'draft';
                $this->save();
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
        if($this->detailPayment()->exists()) return false;
        return true;
    }
}
