<?php

namespace App\Models\Master\AsuransiPerjalanan;

use App\Models\Master\DataAsuransi\FiturAsuransi;
use App\Models\Master\DataAsuransi\IntervalPembayaran;
use App\Models\Master\DataAsuransi\PerusahaanAsuransi;
use App\Models\Model;

class AsuransiPerjalanan extends Model
{
    protected $table = 'ref_asuransi_perjalanan';

    protected $fillable = [
        'perusahaan_asuransi_id',
        'interval_pembayaran_id',
        'pembayaran_persentasi',
        'name',
        'call_center',
        'bank',
        'no_rekening',
        'description',
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
    public function perusahaanAsuransi()
    {
        return $this->belongsTo(PerusahaanAsuransi::class, 'perusahaan_asuransi_id');
    }

    public function intervalPembayaran()
    {
        return $this->belongsTo(IntervalPembayaran::class, 'interval_pembayaran_id');
    }

    public function fiturs()
    {
        return $this->belongsToMany(FiturAsuransi::class, 'ref_asuransi_perjalanan_fitur', 'asuransi_id', 'fitur_id');
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
            $this->fiturs()->sync($request->to ?? []);
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
        $data = $this->name;
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
