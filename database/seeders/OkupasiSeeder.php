<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\Okupasi;
use Illuminate\Database\Seeder;

class OkupasiSeeder extends Seeder
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
                "name" => "Rumah",
                "code" => "001"
            ],
            [ 
                "name" => "Apartemen",
                "code" => "002"
            ],
            [ 
                "name" => "Ruko",
                "code" => "003"
            ],
        ];

        foreach ($data as $val) {
            $record          = Okupasi::firstOrNew(['name' => $val['name']]);
            $record->code = $val['code'];
            $record->save();
        }
    }
}
