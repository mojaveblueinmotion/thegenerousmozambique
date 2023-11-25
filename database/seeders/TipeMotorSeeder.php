<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiMotor\TipeMotor;
use App\Models\Master\DatabaseMobil\TipeMobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeMotorSeeder extends Seeder
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
                "name" => "Matic"
            ],
            [ 
                "name" => "Manual"
            ],
        ];

        foreach ($data as $val) {
            $record          = TipeMotor::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
