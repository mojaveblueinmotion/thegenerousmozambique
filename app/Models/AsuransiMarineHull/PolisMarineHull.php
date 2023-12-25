<?php

namespace App\Models\AsuransiMarineHull;

use App\Models\Model;
use Illuminate\Support\Carbon;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\AsuransiErection\PolisErectionItem;
use App\Models\AsuransiKontraktor\PolisKontraktorItem;
use App\Models\Master\AsuransiKontraktor\ItemKontraktor;

class PolisMarineHull extends Model
{
    protected $table = 'trans_polis_marine_hull';

    protected $fillable = [
        'no_asuransi',
        'no_max',
        'tanggal',
        'agent_id',
        'user_id',
        'asuransi_id',
        'nama_lengkap',
        'alamat',
        'nama_kreditur',
        'alamat_kreditur',
        'detail_kepentingan',
        'lokasi_yard',
        'nilai_maks_yard',
        'konstruksi_bangunan',
        'deskripsi_keamanan',
        'deskripsi_kebakaran',
        'jenis_kapal_dibuat',
        'keterangan_yard',
        'status_subkontraktor',
        'perlindungan_subkontraktor',
        'jadwal_pembangunan',
        'cara_peluncuran',
        'tempat_uji',
        'detail_transportasi',
        'ketersediaan_survey',
        'tanggal_awal',
        'tanggal_akhir',
        'jenis_kapal',
        'perkiraan_nilai',
        'metode_konstruksi',
        'material_konstruksi',
        'panjang',
        'berat',
        'status_penerimaan',
        'keterangan_penerimaan',
        'lama_perusahaan',
        'tahun_pengalaman',
        'kualifikasi_tim',
        'status_klaim',
        'jatuh_tempo',
        'nama_perusahaan_asuransi',
        'status_penolakan',
        'keterangan_penolakan',
        'deskripsi_survey',
        'status',
    ];

    protected $dates = [
        'tanggal',
        'tanggal_awal',
        'tanggal_akhir',
        'jatuh_tempo',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setTanggalAwalAttribute($value)
    {
        $this->attributes['tanggal_awal'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function setTanggalAkhirAttribute($value)
    {
        $this->attributes['tanggal_akhir'] = Carbon::createFromFormat('d/m/Y', $value);
    }
     
    public function setJatuhTempoAttribute($value)
    {
        $this->attributes['jatuh_tempo'] = Carbon::createFromFormat('d/m/Y', $value);
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
