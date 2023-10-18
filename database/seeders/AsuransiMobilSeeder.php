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
                "wilayah_satu_batas_atas" => "2.1",
                "wilayah_satu_batas_bawah" => "1.8",
                "wilayah_dua_batas_atas" => "3.2",
                "wilayah_dua_batas_bawah" => "2.5",
                "wilayah_tiga_batas_atas" => "4.4",
                "wilayah_tiga_batas_bawah" => "3.1",
                "kategori_asuransi_id" => 1,
                "name" => "Tugu Asuransi",
                "call_center" => "01823213123"
            ],
            [ 
                "perusahaan_asuransi_id" => 2,
                "interval_pembayaran_id" => 1,
                "wilayah_satu_batas_atas" => "2.1",
                "wilayah_satu_batas_bawah" => "1.8",
                "wilayah_dua_batas_atas" => "3.2",
                "wilayah_dua_batas_bawah" => "2.5",
                "wilayah_tiga_batas_atas" => "4.4",
                "wilayah_tiga_batas_bawah" => "3.1",
                "kategori_asuransi_id" => 1,
                "name" => "Sinar Mas Asuransi",
                "call_center" => "08192121221"
            ],
            [ 
                "perusahaan_asuransi_id" => 3,
                "interval_pembayaran_id" => 1,
                "wilayah_satu_batas_atas" => "0.8",
                "wilayah_satu_batas_bawah" => "0.2",
                "wilayah_dua_batas_atas" => "1.2",
                "wilayah_dua_batas_bawah" => "0.8",
                "wilayah_tiga_batas_atas" => "1.9",
                "wilayah_tiga_batas_bawah" => "0.9",
                "kategori_asuransi_id" => 2,
                "name" => "ACA Asuransi",
                "call_center" => "08121212212"
            ]
        ];

        foreach ($data as $val) {
            $record          = AsuransiMobil::firstOrNew(['name' => $val['name']]);
            $record->perusahaan_asuransi_id = $val['perusahaan_asuransi_id'];
            $record->interval_pembayaran_id = $val['interval_pembayaran_id'];
            $record->wilayah_satu_batas_atas = $val['wilayah_satu_batas_atas'];
            $record->wilayah_satu_batas_bawah = $val['wilayah_satu_batas_bawah'];
            $record->wilayah_dua_batas_atas = $val['wilayah_dua_batas_atas'];
            $record->wilayah_dua_batas_bawah = $val['wilayah_dua_batas_bawah'];
            $record->wilayah_tiga_batas_atas = $val['wilayah_tiga_batas_atas'];
            $record->wilayah_tiga_batas_bawah = $val['wilayah_tiga_batas_bawah'];
            $record->kategori_asuransi_id = $val['kategori_asuransi_id'];
            $record->call_center = $val['call_center'];
            $record->save();
        }
    }
}
