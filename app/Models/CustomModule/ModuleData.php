<?php

namespace App\Models\CustomModule;

use App\Models\Model;
use Illuminate\Support\Collection;
use App\Models\CustomModule\Module;
use App\Models\Master\DatabaseMobil\Seri;

class ModuleData extends Model
{
    protected $table = 'trans_custom_module_data';

    protected $fillable = [
        'module_id',
        'no_asuransi',
        'no_max',
        'status',
        'user_id',
        'data',
    ];

    /*******************************
     ** MUTATOR
     *******************************/

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

    /*******************************
     ** RELATION
     *******************************/

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    /*******************************
     ** SCOPE
     *******************************/

    public function scopeFilters($query)
    {
        return $query->filterBy(['title']);
    }

    /*******************************
     ** SAVING
     *******************************/
}
