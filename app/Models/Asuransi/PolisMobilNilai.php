<?php

namespace App\Models\Asuransi;

use App\Models\Model;
use Illuminate\Support\Carbon;
use App\Models\Asuransi\PolisMobil;

class PolisMobilNilai extends Model
{
    protected $table = 'trans_polis_mobil_nilai';

    protected $fillable = [
        'polis_id',
        'rincian_modifikasi',
        'nilai_modifikasi',
        'tipe',
        'nilai_mobil',
        // 'nilai_pertanggungan',
        'tahun_awal',
        'tahun_akhir',
        'pemakaian',
        'tanggal_awal',
        'tanggal_akhir',
        'no_plat',
    ];

    protected $dates = [
        'tanggal_awal',
        'tanggal_akhir',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

    public function setTanggalAkhirAttribute($value)
    {
        $this->attributes['tanggal_akhir'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setTanggalAwalAttribute($value)
    {
        $this->attributes['tanggal_awal'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    /*******************************
     ** ACCESSOR
     *******************************/

    /*******************************
     ** RELATION
     *******************************/
    public function polis()
    {
        return $this->belongsTo(PolisMobil::class, 'polis_id');
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
        return $query->filterBy(['rincian_modifikasi']);
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
        $data = $this->tipe;
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
