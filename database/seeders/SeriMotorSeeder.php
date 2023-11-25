<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\DatabaseMobil\Seri;
use App\Models\Master\AsuransiMotor\Seri as SeriMotor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeriMotorSeeder extends Seeder
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
                "merk_id" => 1,
                "code" => "NMAX23",
                "model" => "NMAX 155cc 2023"
            ],
            [ 
                "merk_id" => 1,
                "code" => "NMAX20",
                "model" => "NMAX 155cc 2020"
            ],
            [ 
                "merk_id" => 2,
                "code" => "PCX22",
                "model" => "PCX 155cc 2022"
            ],
            [ 
                "merk_id" => 3,
                "code" => "VESPAS18",
                "model" => "Vespa S 150 2018"
            ],
        ];

        foreach ($data as $val) {
            $record          = SeriMotor::firstOrNew(['code' => $val['code']]);
            $record->merk_id = $val['merk_id'];
            $record->model = $val['model'];
            $record->save();
        }
    }
}
