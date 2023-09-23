<?php

namespace Database\Seeders;

use App\Models\Master\DataAsuransi\IntervalPembayaran;
use Illuminate\Database\Seeder;

class IntervalPembayaranSeeder extends Seeder
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
                "name" => "Bulanan"
            ],
            [ 
                "name" => "Triwulan"
            ],
            [ 
                "name" => "Tahunan"
            ],
        ];

        foreach ($data as $val) {
            $record          = IntervalPembayaran::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
