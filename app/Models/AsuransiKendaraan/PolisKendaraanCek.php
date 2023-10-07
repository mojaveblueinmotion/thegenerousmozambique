<?php

namespace App\Models\AsuransiKendaraan;

use App\Models\Model;
use Illuminate\Support\Carbon;
use App\Models\Asuransi\PolisMobil;
use App\Models\Master\DatabaseMobil\Merk;
use App\Models\Master\DatabaseMobil\Seri;
use App\Models\Master\DatabaseMobil\Tipe;
use App\Models\Master\DatabaseMobil\Tahun;
use App\Models\Master\DatabaseMobil\KodePlat;
use App\Models\Master\DatabaseMobil\TipeMobil;
use App\Models\AsuransiKendaraan\PolisKendaraan;
use App\Models\Master\AsuransiMobil\TipePemakaian;
use App\Models\Master\DatabaseMobil\TipeKendaraan;
use App\Models\Master\AsuransiMobil\KondisiKendaraan;
use App\Models\Master\AsuransiMobil\LuasPertanggungan;

class PolisKendaraanCek extends Model
{
    protected $table = 'trans_polis_kendaraan_cek';

    protected $fillable = [
        'polis_id',
        'merk',
        'tahun',
        'seri',
        'warna',
        'kode_plat',
        'tipe_id',
        'tipe_kendaraan_id',
        'kode_plat_id',
        'tipe_pemakaian_id',
        'luas_pertanggungan_id',
        'kondisi_kendaraan_id',
        'harga_mobil',
    ];
    
    /*******************************
     ** MUTATOR
     *******************************/

    /*******************************
     ** ACCESSOR
     *******************************/

    /*******************************
     ** RELATION
     *******************************/
    public function polis()
    {
        return $this->belongsTo(PolisKendaraan::class, 'polis_id');
    }

    public function tipeMobil()
    {
        return $this->belongsTo(TipeMobil::class, 'tipe_id');
    }

    public function kodePlat()
    {
        return $this->belongsTo(KodePlat::class, 'kode_plat_id');
    }

    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'tipe_kendaraan_id');
    }

    public function tipePemakaian()
    {
        return $this->belongsTo(TipePemakaian::class, 'tipe_pemakaian_id');
    }

    public function luasPertanggungan()
    {
        return $this->belongsTo(LuasPertanggungan::class, 'luas_pertanggungan_id');
    }
    
    public function kondisiKendaraan()
    {
        return $this->belongsTo(KondisiKendaraan::class, 'kondisi_kendaraan_id');
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
        return $query->filterBy(['kode_plat']);
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
