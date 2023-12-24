<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\Master\DataAsuransi\IntervalPembayaran;
use Illuminate\Database\Seeder;

class SubsoilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 
                "name" => "Batuan"
            ],
            [ 
                "name" => "Kerikil"
            ],
            [ 
                "name" => "Pasir"
            ],
            [ 
                "name" => "Tanah Liat"
            ],
            [ 
                "name" => "Lahan Urukan"
            ],
            [ 
                "name" => "Lainnya"
            ],
        ];

        foreach ($data as $val) {
            $record          = Subsoil::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
