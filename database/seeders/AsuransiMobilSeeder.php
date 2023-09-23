<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiMobil\AsuransiMobil;
use Illuminate\Database\Seeder;

class AsuransiMobilSeeder extends Seeder
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
                "perusahaan_asuransi_id" => 1,
                "interval_pembayaran_id" => 1,
                "pembayaran_persentasi" => "11,000,000",
                "name" => "Tugu Asuransi",
                "call_center" => "01823213123"
            ],
            [ 
                "perusahaan_asuransi_id" => 2,
                "interval_pembayaran_id" => 1,
                "pembayaran_persentasi" => "1,100,000",
                "name" => "Sinar Mas Asuransi",
                "call_center" => "08192121221"
            ],
            [ 
                "perusahaan_asuransi_id" => 3,
                "interval_pembayaran_id" => 1,
                "pembayaran_persentasi" => "1,000,000",
                "name" => "ACA Asuransi",
                "call_center" => "08121212212"
            ]
        ];

        foreach ($data as $val) {
            $record          = AsuransiMobil::firstOrNew(['name' => $val['name']]);
            $record->perusahaan_asuransi_id = $val['perusahaan_asuransi_id'];
            $record->interval_pembayaran_id = $val['interval_pembayaran_id'];
            $record->pembayaran_persentasi = $val['pembayaran_persentasi'];
            $record->call_center = $val['call_center'];
            $record->save();
            $record->save();
        }
    }
}
