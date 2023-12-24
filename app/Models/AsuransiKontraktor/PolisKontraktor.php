<?php

namespace App\Models\AsuransiKontraktor;

use App\Models\Model;
use Illuminate\Support\Carbon;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\AsuransiKontraktor\PolisKontraktorItem;
use App\Models\Master\AsuransiKontraktor\ItemKontraktor;

class PolisKontraktor extends Model
{
    protected $table = 'trans_polis_kontraktor';

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
        'nama_insinyur',
        'alamat_insinyur',
        'lebar_dimensi',
        'tinggi_dimensi',
        'kedalaman_dimensi',
        'rentang_dimensi',
        'jumlah_lantai',
        'metode_konstruksi',
        'jenis_pondasi',
        'bahan_konstruksi',
        'kontraktor_berpengalaman',
        'awal_periode',
        'lama_proses_konstruksi',
        'tanggal_penyelesaian',
        'periode_pemeliharaan',
        'pekerjaan_subkontraktor',
        'fire_explosion',
        'flood_inundation',
        'landslide_storm_cyclone',
        'blasting_work',
        'volcanic_tsunami',
        'skala_mercalli',
        'observed_earthquake',
        'magnitude',
        'regulasi_struktur',
        'standar_rancangan',
        'subsoil_id',
        'patahan_geologi',
        'perairan_terdekat',
        'jarak_perairan',
        'level_air',
        'rata_rata_air',
        'tingkat_tertinggi_air',
        'tanggal_tercatat',
        'musim_hujan_awal',
        'musim_hujan_akhir',
        'curah_hujan_perjam',
        'curah_hujan_perhari',
        'curah_hujan_perbulan',
        'bahaya_badai',
        'biaya_tambahan_lembur',
        'batas_ganti_rugi_lembur',
        'tanggung_jawab_pihak_ketiga',
        'asuransi_terpisah_tpl',
        'batas_ganti_rugi_pihak_ketiga',
        'rincian_bangunan',
        'status_struktur_bangunan',
        'batas_ganti_rugi_struktur_bangunan',
        'status',
    ];

    protected $dates = [
        'tanggal',
        'awal_periode',
        'tanggal_penyelesaian',
        'tanggal_tercatat',
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
    
    public function setTanggalPenyelesaianAttribute($value)
    {
        $this->attributes['tanggal_penyelesaian'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setTanggalTercatatAttribute($value)
    {
        $this->attributes['tanggal_tercatat'] = Carbon::createFromFormat('d/m/Y', $value);
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
    public function subsoil()
    {
        return $this->belongsTo(Subsoil::class, 'subsoil_id');
    }

    public function itemKontraktor()
    {
        return $this->hasMany(PolisKontraktorItem::class, 'polis_id');
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
