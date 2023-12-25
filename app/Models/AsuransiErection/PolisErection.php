<?php

namespace App\Models\AsuransiErection;

use App\Models\Model;
use Illuminate\Support\Carbon;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\AsuransiErection\PolisErectionItem;
use App\Models\AsuransiKontraktor\PolisKontraktorItem;
use App\Models\Master\AsuransiKontraktor\ItemKontraktor;

class PolisErection extends Model
{
    protected $table = 'trans_polis_erection';

    protected $fillable = [
        'no_asuransi',
        'no_max',
        'tanggal',
        'agent_id',
        'user_id',
        'asuransi_id',
        'judul_kontrak',
        'lokasi_proyek',
        'nama_prinsipal',
        'alamat_prinsipal',
        'nama_kontraktor',
        'alamat_kontraktor',
        'nama_subkontraktor',
        'alamat_subkontraktor',
        'nama_pabrik',
        'alamat_pabrik',
        'nama_perusahaan',
        'alamat_perusahaan',
        'nama_insinyur',
        'alamat_insinyur',
        'no_pemohon',
        'no_tertanggung',
        'keterangan',
        'awal_periode',
        'lama_prapenyimpanan',
        'awal_pekerjaan',
        'lama_pekerjaan',
        'lama_pengujian',
        'jenis_perlindungan',
        'penghentian_asuransi',
        'pekerjaan_konstruksi_sebelumnya',
        'pekerjaan_konstruksi_kontraktor',
        'perluasan',
        'status_operasi',
        'pekerjaan_sipil',
        'pekerjaan_subkontraktor',
        'resiko_kebakaran',
        'resiko_ledakan',
        'perairan_terdekat',
        'jarak_perairan',
        'air_rendah',
        'rata_rata_air',
        'tingkat_tertinggi_air',
        'rata_rata_air_lokasi',
        'musim_hujan_awal',
        'musim_hujan_akhir',
        'curah_hujan_perjam',
        'curah_hujan_perhari',
        'curah_hujan_perbulan',
        'bahaya_badai',
        'bahaya_gempa',
        'riwayat_volkanik',
        'status_gempa',
        'bangunan_gempa',
        'loss_tertinggi',
        'perlindungan_peralatan',
        'deskripsi_pernyataan',
        'perlindungan_mesin',
        'perlindungan_sekitaran',
        'deskripsi_sekitaran',
        'tanggung_jawab_pihak_ketiga',
        'deskripsi_pihak_ketiga',
        'perlindungan_libur',
        'perlindungan_udara',
        'deskripsi_perlindungan',
        'jumlah_diasuransikan',
        'status',
    ];

    protected $dates = [
        'tanggal',
        'awal_periode',
        'awal_pekerjaan',
        'musim_hujan_awal',
        'musim_hujan_akhir',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setAwalPeriodeAttribute($value)
    {
        $this->attributes['awal_periode'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setAwalPekerjaanAttribute($value)
    {
        $this->attributes['awal_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setMusimHujanAwalAttribute($value)
    {
        $this->attributes['musim_hujan_awal'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setMusimHujanAkhirAttribute($value)
    {
        $this->attributes['musim_hujan_akhir'] = Carbon::createFromFormat('d/m/Y', $value);
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

    public function itemErection()
    {
        return $this->hasMany(PolisErectionItem::class, 'polis_id');
    }


    /*******************************
     ** SCOPE
     *******************************/
    
    public function scopeGrid($query)
    {
        return $query->latest();
    }

    public function scopeFilters($query)
    {
        return $query->filterBy(['judul_kontrak']);
    }

    /*******************************
     ** SAVING
     *******************************/

    public function handleDetailPolisStoreOrUpdate($request)
    {
        $this->beginTransaction();
        try {
            $this->fill($request->all());
            $this->save();
            $this->saveLogNotify();

            $redirect = route(request()->get('routes') . '.detail', $this->polis->id);
            return $this->commitSaved();
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function handleDetailPolisDestroy()
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

    public function saveLogNotify()
    {
        $data = $this->kode_plat;
        $routes = request()->get('routes');
        switch (request()->route()->getName()) {
            case $routes . '.store':
                $this->addLog('Membuat Data ' . $data);
                break;
            case $routes . '.update':
                $this->addLog('Mengubah Data ' . $data);
                break;
            case $routes . '.destroy':
                $this->addLog('Menghapus Data ' . $data);
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
                $checkStatus = in_array($this->status, ['new', 'draft', 'rejected']);
                return $checkStatus && $user->checkPerms($perms . '.edit');
                break;

            case 'delete':
                $checkStatus = in_array($this->status, ['new', 'draft', 'rejected']);
                return $checkStatus && $user->checkPerms($perms . '.delete');
                break;

            case 'approval':
                if ($this->checkApproval(request()->get('module'))) {
                    $checkStatus = in_array($this->status, ['waiting.approval']);
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
        // if($this->moduleRelations()->exists()) return false;
        return true;
    }

    public function detailCreationDate()
    {
        $date = ($this->reg_updated_at ?: $this->updated_at) ?? $this->created_at;
        return Carbon::parse($date)->translatedFormat('d M Y, H:i');
    }
    public function detailCreatorName()
    {
        if ($this->update_by) {
            return $this->update_by->name;
        }
        return isset($this->update_by->name) ? $this->update_by->name : $this->creatorName();
    }
}
