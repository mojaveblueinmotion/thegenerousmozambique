<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use Illuminate\Database\Seeder;

class PerlindunganPropertiSeeder extends Seeder
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
                "name" => "Flexas"
            ],
            [ 
                "name" => "Property All Risk"
            ],
            [ 
                "name" => "Gempa Bumi"
            ],
            [ 
                "name" => "Banjir"
            ],
            [ 
                "name" => "Kebakaran"
            ],
            [ 
                "name" => "Banjir, Angin Topan, Badai dan Kerusakan Akibat Air (FSTWD)"
            ],
            [ 
                "name" => "Kerusuhan, Pemogokan, Pengrusakan harta benda akibat tindakan jahat serta Huru Hara (Riot,Strike,Malicious Damage,Civil Commotion /RSMDCC)"
            ],
        ];

        foreach ($data as $val) {
            $record          = PerlindunganProperti::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
