<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use Illuminate\Database\Seeder;

class KonstruksiPropertiSeeder extends Seeder
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
                "name" => "Kelas Konstruksi 1"
            ],
            [ 
                "name" => "Kelas Konstruksi 2"
            ],
            [ 
                "name" => "Kelas Konstruksi 3"
            ],
        ];

        foreach ($data as $val) {
            $record          = KonstruksiProperti::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
