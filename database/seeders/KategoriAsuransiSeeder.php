<?php

namespace Database\Seeders;

use App\Models\Master\DataAsuransi\KategoriAsuransi;
use Illuminate\Database\Seeder;

class KategoriAsuransiSeeder extends Seeder
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
                "name" => "Comprehensive",
            ],
            [ 
                "name" => "Total Loss",
            ],
        ];

        foreach ($data as $val) {
            $record          = KategoriAsuransi::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
