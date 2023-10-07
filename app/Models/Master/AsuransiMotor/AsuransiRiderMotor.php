<?php

namespace App\Models\Master\AsuransiMotor;

use App\Models\Model;
use App\Imports\Master\ExampleImport;
use App\Models\Setting\Globals\TempFiles;
use App\Models\Master\AsuransiMotor\RiderMotor;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\AsuransiMotor\AsuransiMotor;
use App\Models\Master\DataAsuransi\RiderKendaraan;

class AsuransiRiderMotor extends Model
{
    protected $table = 'ref_asuransi_motor_rider';

    protected $fillable = [
        'asuransi_id',
        'rider_kendaraan_id',
        'pembayaran_persentasi',
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
    public function asuransiMotor()
    {
        return $this->belongsTo(AsuransiMotor::class, 'asuransi_id');
    }

    public function riderKendaraan()
    {
        return $this->belongsTo(RiderMotor::class, 'rider_kendaraan_id');
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
