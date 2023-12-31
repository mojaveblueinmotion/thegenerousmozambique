<?php

namespace App\Models\Master\AsuransiMobil;

use App\Models\Model;
use App\Imports\Master\ExampleImport;
use App\Models\Setting\Globals\TempFiles;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\DataAsuransi\RiderKendaraan;

class AsuransiPersentasiMobil extends Model
{
    protected $table = 'ref_asuransi_mobil_persentasi';

    protected $fillable = [
        'asuransi_id',
        'kategori',
        'uang_pertanggungan_bawah',
        'uang_pertanggungan_atas',
        'wilayah_satu_atas',
        'wilayah_satu_bawah',
        'wilayah_dua_atas',
        'wilayah_dua_bawah',
        'wilayah_tiga_atas',
        'wilayah_tiga_bawah',
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
    public function asuransiMobil()
    {
        return $this->belongsTo(AsuransiMobil::class, 'asuransi_id');
    }
    
    /*******************************
     ** SCOPE
     *******************************/

    public function scopeFilters($query)
    {
        return $query->filterBy(['name']);
    }

    /*******************************
     ** SAVING
     *******************************/
    public function handleStoreOrUpdate($request)
    {
        $this->beginTransaction();
        try {
            $this->fill($request->only($this->fillable));
            $this->save();
            $this->saveLogNotify();

            return $this->commitSaved();
        } catch (\Exception $e) {
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

    public function handleImport($request)
    {
        $this->beginTransaction();
        try {
            $file = TempFiles::find($request->uploads['temp_files_ids'][0]);
            if (!$file || !\Storage::disk('public')->exists($file->file_path)) {
                $this->rollback('File tidak tersedia!');
            }

            $filePath = \Storage::disk('public')->path($file->file_path);
            \Excel::import(new ExampleImport(), $filePath);

            $this->saveLogNotify();

            return $this->commitSaved();
        } catch (\Exception $e) {
            return $this->rollbackSaved($e);
        }
    }

    public function saveLogNotify()
    {
        $data = $this->year.' | '.$this->merk.' | '.$this->type;
        $routes = request()->get('routes');
        switch (request()->route()->getName()) {
            case $routes.'.store':
                $this->addLog('Membuat Data '.$data);
                break;
            case $routes.'.update':
                $this->addLog('Mengubah Data '.$data);
                break;
            case $routes.'.destroy':
                $this->addLog('Menghapus Data '.$data);
                break;
        }
    }

    /*******************************
     ** OTHER FUNCTIONS
     *******************************/
    public function canDeleted()
    {
        return true;
    }
}
