<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\DatabaseMobil\Tahun;
use App\Models\Master\AsuransiMotor\Tahun as TahunMotor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TahunMotorSeeder extends Seeder
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
                "seri_id" => 2,
                "tahun" => "2020",
                "harga" => "30000000"
            ],
            [ 
                "seri_id" => 1,
                "tahun" => "2023",
                "harga" => "35000000"
            ],
            [ 
                "seri_id" => 3,
                "tahun" => "2022",
                "harga" => "32000000"
            ],
            [ 
                "seri_id" => 4,
                "tahun" => "2018",
                "harga" => "25000000"
            ],
        ];

        foreach ($data as $val) {
            $record          = TahunMotor::firstOrNew(
                [
                    'seri_id' => $val['seri_id'],
                    'tahun' => $val['tahun'],
                    'harga' => $val['harga'],
                ]
            );
            $record->save();
        }
    }
}
