<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiMotor\RiderMotor;
use App\Models\Master\AsuransiProperti\Okupasi;
use App\Models\Master\DataAsuransi\PertanggunganTambahan;
use App\Models\Master\DataAsuransi\RiderKendaraan;
use Illuminate\Database\Seeder;

class RiderSeeder extends Seeder
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
                "name" => "Angin Topan, Badai, & Banjir",
                "description" => null,
                'pertanggungan_id' => null,
            ],
            [ 
                "name" => "Gempa Bumi, Tsunami, & Bencana Alam",
                "description" => null,
                'pertanggungan_id' => null
            ],
            [ 
                "name" => "Huru-Hara & Kerusuhan",
                "description" => null,
                'pertanggungan_id' => null
            ],
            [ 
                "name" => "Kecelakaan Diri Penumpang",
                "description" => null,
                'pertanggungan_id' => 2
            ],
            [ 
                "name" => "Kecelakaan Diri Pengemudi",
                "description" => null,
                'pertanggungan_id' => 1
            ],
            [ 
                "name" => "Tanggung Jawab Hukum Terhadap Pihak Ketiga",
                "description" => null,
                'pertanggungan_id' => 5
            ],
            [ 
                "name" => "Terorisme & Sabotase",
                "description" => null,
                'pertanggungan_id' => null
            ],
            [ 
                "name" => "Tanggung Jawab Hukum Terhadap Penumpang",
                "description" => null,
                'pertanggungan_id' => 6
            ],
        ];

        foreach ($data as $val) {
            $record          = RiderKendaraan::firstOrNew(['name' => $val['name']]);
            $record->pertanggungan_id = $val['pertanggungan_id'];
            $record->description = $val['description'];
            $record->save();
        }

        $dataMotor = [
            [ 
                "name" => "Angin Topan, Badai, & Banjir",
                "description" => null,
                'pertanggungan_id' => null,
            ],
            [ 
                "name" => "Gempa Bumi, Tsunami, & Bencana Alam",
                "description" => null,
                'pertanggungan_id' => null
            ],
            [ 
                "name" => "Huru-Hara & Kerusuhan",
                "description" => null,
                'pertanggungan_id' => null
            ],
            [ 
                "name" => "Kecelakaan Diri Penumpang",
                "description" => null,
                'pertanggungan_id' => 2
            ],
            [ 
                "name" => "Kecelakaan Diri Pengemudi",
                "description" => null,
                'pertanggungan_id' => 1
            ],
            [ 
                "name" => "Tanggung Jawab Hukum Terhadap Pihak Ketiga",
                "description" => null,
                'pertanggungan_id' => 5
            ],
            [ 
                "name" => "Terorisme & Sabotase",
                "description" => null,
                'pertanggungan_id' => null
            ],
            [ 
                "name" => "Tanggung Jawab Hukum Terhadap Penumpang",
                "description" => null,
                'pertanggungan_id' => 6
            ],
        ];

        foreach ($dataMotor as $vals) {
            $record          = RiderMotor::firstOrNew(['name' => $vals['name']]);
            $record->pertanggungan_id = $vals['pertanggungan_id'];
            $record->description = $vals['description'];
            $record->save();
        }
    }
}
