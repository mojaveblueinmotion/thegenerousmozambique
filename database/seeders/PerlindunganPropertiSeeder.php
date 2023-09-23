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
        ];

        foreach ($data as $val) {
            $record          = PerlindunganProperti::firstOrNew(['name' => $val['name']]);
            $record->save();
        }
    }
}
