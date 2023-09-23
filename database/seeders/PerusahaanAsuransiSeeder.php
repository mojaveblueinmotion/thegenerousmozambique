<?php

namespace Database\Seeders;

use App\Models\Master\DataAsuransi\PerusahaanAsuransi;
use Illuminate\Database\Seeder;

class PerusahaanAsuransiSeeder extends Seeder
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
                "name" => "TUGU"
            ],
            [ 
                "name" => "Sinar Mas"
            ],
            [ 
                "name" => "ACA"
            ],
        ];

        foreach ($data as $val) {
            $record          = PerusahaanAsuransi::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
