<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\Okupasi;
use Illuminate\Database\Seeder;

class OkupasiSeeder extends Seeder
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
                "name" => "Dwelling House",
                "code" => "2976",
                'tarif_konstruksi_satu' => 0.294,
                'tarif_konstruksi_dua' => 0.397,
                'tarif_konstruksi_tiga' => 0.499,
            ],
            [ 
                "name" => "Dwelling House for Boarding House",
                "code" => "29761",
                'tarif_konstruksi_satu' => 0.478,
                'tarif_konstruksi_dua' => 0.645,
                'tarif_konstruksi_tiga' => 0.812,
            ],
        ];

        foreach ($data as $val) {
            $record          = Okupasi::firstOrNew(['name' => $val['name']]);
            $record->code = $val['code'];
            $record->tarif_konstruksi_satu = $val['tarif_konstruksi_satu'];
            $record->tarif_konstruksi_dua = $val['tarif_konstruksi_dua'];
            $record->tarif_konstruksi_tiga = $val['tarif_konstruksi_tiga'];
            $record->save();
        }
    }
}
