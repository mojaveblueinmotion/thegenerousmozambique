<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\Master\AsuransiProperti\SurroundingRisk;
use Illuminate\Database\Seeder;

class SurroundingRiskSeeder extends Seeder
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
                "name" => "Kos-Kosan",
                'tingkat_resiko' => 1
            ],
            [ 
                "name" => "Restoran",
                'tingkat_resiko' => 3
            ],
            [ 
                "name" => "Pom Bensin",
                'tingkat_resiko' => 5
            ],
            [ 
                "name" => "Gudang",
                'tingkat_resiko' => 4
            ],
            [ 
                "name" => "Sekolah",
                'tingkat_resiko' => 2
            ],
        ];

        foreach ($data as $val) {
            $record          = SurroundingRisk::firstOrNew(['name' => $val['name']]);
            $record->tingkat_resiko = $val['tingkat_resiko'];
            $record->save();
        }
    }
}
