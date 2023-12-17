<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\KelasBangunan;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\Master\AsuransiProperti\SurroundingRisk;
use Illuminate\Database\Seeder;

class KelasBangunanSeeder extends Seeder
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
                "name" => "Kelas Bangunan 1",
            ],
            [ 
                "name" => "Kelas Bangunan 2",
            ],
            [ 
                "name" => "Kelas Bangunan 3",
            ],
        ];

        foreach ($data as $val) {
            $record          = KelasBangunan::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
