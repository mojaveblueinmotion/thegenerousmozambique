<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\Master\DataAsuransi\PertanggunganTambahan;
use Illuminate\Database\Seeder;

class PertanggunganTambahanSeeder extends Seeder
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
                "name" => "Kecelakaan Diri Pengemudi",
                "description" => null
            ],
            [ 
                "name" => "Kecelakaan Diri Penumpang",
                "description" => null
            ],
            [ 
                "name" => "Medical Expense Pengemudi",
                "description" => null
            ],
            [ 
                "name" => "Medical Expense Penumpang",
                "description" => null
            ],
            [ 
                "name" => "Tanggung Jawab Hukum Pihak Ketiga",
                "description" => null
            ],
            [ 
                "name" => "Tanggung Jawab Hukum Penumpang",
                "description" => null
            ],
        ];

        foreach ($data as $val) {
            $record          = PertanggunganTambahan::firstOrNew(['name' => $val['name']]);
            $record->description = $val['description'];
            $record->save();
        }
    }
}
