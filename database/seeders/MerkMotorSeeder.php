<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiMotor\Merk as AsuransiMotorMerk;
use App\Models\Master\DatabaseMobil\Merk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerkMotorSeeder extends Seeder
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
                "name" => "Yamaha",
                "status" => "populer"
            ],
            [ 
                "name" => "Honda",
                "status" => "populer"
            ],
            [ 
                "name" => "Vespa",
                "status" => "non-populer"
            ],
        ];

        foreach ($data as $val) {
            $record          = AsuransiMotorMerk::firstOrNew(['name' => $val['name']]);
            $record->status = $val['status'];
            $record->save();
        }
    }
}
