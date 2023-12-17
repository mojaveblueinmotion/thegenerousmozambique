<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use Illuminate\Database\Seeder;

class KonstruksiPropertiSeeder extends Seeder
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
                "name" => "Kelas Konstruksi Industri Komersil Tingkat < 9",
                "zona_satu" => 0.75,
                "zona_dua" => 0.76,
                "zona_tiga" => 1.00,
                "zona_empat" => 1.43,
                "zona_lima" => 1.90,
            ],
            [ 
                "name" => "Kelas Konstruksi Industri Komersil Tingkat > 9",
                "zona_satu" => 1.12,
                "zona_dua" => 1.15,
                "zona_tiga" => 1.22,
                "zona_empat" => 1.53,
                "zona_lima" => 2.00,
            ],
            [ 
                "name" => "Kelas Konstruksi Dwelling House",
                "zona_satu" => 0.76,
                "zona_dua" => 0.79,
                "zona_tiga" => 1.04,
                "zona_empat" => 1.35,
                "zona_lima" => 1.60,
            ],
        ];

        foreach ($data as $val) {
            $record          = KonstruksiProperti::firstOrNew(['name' => $val['name']]);
            $record->zona_satu = $val['zona_satu'];
            $record->zona_dua = $val['zona_dua'];
            $record->zona_tiga = $val['zona_tiga'];
            $record->zona_empat = $val['zona_empat'];
            $record->zona_lima = $val['zona_lima'];
            $record->save();
        }
    }
}
