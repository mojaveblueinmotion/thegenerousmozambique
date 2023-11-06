<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\AsuransiMobil\AsuransiRiderMobil;
use App\Models\Master\AsuransiMobil\AsuransiPersentasiMobil;

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
                "kategori_asuransi_id" => 1,
                "name" => "Tugu Asuransi",
                "call_center" => "01823213123"
            ],
            [ 
                "perusahaan_asuransi_id" => 2,
                "interval_pembayaran_id" => 1,
                "kategori_asuransi_id" => 1,
                "name" => "Sinar Mas Asuransi",
                "call_center" => "08192121221"
            ],
            [ 
                "perusahaan_asuransi_id" => 3,
                "interval_pembayaran_id" => 1,
                "kategori_asuransi_id" => 2,
                "name" => "ACA Asuransi",
                "call_center" => "08121212212"
            ]
        ];

        foreach ($data as $val) {
            $record          = AsuransiMobil::firstOrNew(['name' => $val['name']]);
            $record->perusahaan_asuransi_id = $val['perusahaan_asuransi_id'];
            $record->interval_pembayaran_id = $val['interval_pembayaran_id'];
            $record->kategori_asuransi_id = $val['kategori_asuransi_id'];
            $record->call_center = $val['call_center'];
            $record->save();
        }

        $dataPersentasi = [
            [ 
                "asuransi_id" => 3,
                "kategori" => "Kategori 1",
                "uang_pertanggungan_bawah" => 0,
                "uang_pertanggungan_atas" => 125000000,
                "wilayah_satu_atas" => 4.200,
                "wilayah_satu_bawah" => 3.820,
                "wilayah_dua_atas" => 3.590,
                "wilayah_dua_bawah" => 3.260,
                "wilayah_tiga_atas" => 2.780,
                "wilayah_tiga_bawah" => 2.530
            ],
            [ 
                "asuransi_id" => 3,
                "kategori" => "Kategori 2",
                "uang_pertanggungan_bawah" => 125000000,
                "uang_pertanggungan_atas" => 200000000,
                "wilayah_satu_atas" => 2.940,
                "wilayah_satu_bawah" => 2.670,
                "wilayah_dua_atas" => 2.720,
                "wilayah_dua_bawah" => 2.470,
                "wilayah_tiga_atas" => 2.960,
                "wilayah_tiga_bawah" => 2.690
            ],
            [ 
                "asuransi_id" => 3,
                "kategori" => "Kategori 3",
                "uang_pertanggungan_bawah" => 200000000,
                "uang_pertanggungan_atas" => 400000000,
                "wilayah_satu_atas" => 2.400,
                "wilayah_satu_bawah" => 2.180,
                "wilayah_dua_atas" => 2.290,
                "wilayah_dua_bawah" => 2.080,
                "wilayah_tiga_atas" => 1.970,
                "wilayah_tiga_bawah" => 1.790
            ],
            [ 
                "asuransi_id" => 3,
                "kategori" => "Kategori 4",
                "uang_pertanggungan_bawah" => 400000000,
                "uang_pertanggungan_atas" => 800000000,
                "wilayah_satu_atas" => 1.320,
                "wilayah_satu_bawah" => 1.200,
                "wilayah_dua_atas" => 1.320,
                "wilayah_dua_bawah" => 1.200,
                "wilayah_tiga_atas" => 1.250,
                "wilayah_tiga_bawah" => 1.140
            ],
            [ 
                "asuransi_id" => 3,
                "kategori" => "Kategori 5",
                "uang_pertanggungan_bawah" => 800000000,
                "uang_pertanggungan_atas" => 0,
                "wilayah_satu_atas" => 1.160,
                "wilayah_satu_bawah" => 1.050,
                "wilayah_dua_atas" => 1.160,
                "wilayah_dua_bawah" => 1.050,
                "wilayah_tiga_atas" => 1.160,
                "wilayah_tiga_bawah" => 1.050
            ],

            [ 
                "asuransi_id" => 2,
                "kategori" => "Kategori 1",
                "uang_pertanggungan_bawah" => 0,
                "uang_pertanggungan_atas" => 125000000,
                "wilayah_satu_atas" => 4.200,
                "wilayah_satu_bawah" => 3.820,
                "wilayah_dua_atas" => 3.590,
                "wilayah_dua_bawah" => 3.260,
                "wilayah_tiga_atas" => 2.780,
                "wilayah_tiga_bawah" => 2.530
            ],
            [ 
                "asuransi_id" => 2,
                "kategori" => "Kategori 2",
                "uang_pertanggungan_bawah" => 125000000,
                "uang_pertanggungan_atas" => 200000000,
                "wilayah_satu_atas" => 2.940,
                "wilayah_satu_bawah" => 2.670,
                "wilayah_dua_atas" => 2.720,
                "wilayah_dua_bawah" => 2.470,
                "wilayah_tiga_atas" => 2.960,
                "wilayah_tiga_bawah" => 2.690
            ],
            [ 
                "asuransi_id" => 2,
                "kategori" => "Kategori 3",
                "uang_pertanggungan_bawah" => 200000000,
                "uang_pertanggungan_atas" => 400000000,
                "wilayah_satu_atas" => 2.400,
                "wilayah_satu_bawah" => 2.180,
                "wilayah_dua_atas" => 2.290,
                "wilayah_dua_bawah" => 2.080,
                "wilayah_tiga_atas" => 1.970,
                "wilayah_tiga_bawah" => 1.790
            ],
            [ 
                "asuransi_id" => 2,
                "kategori" => "Kategori 4",
                "uang_pertanggungan_bawah" => 400000000,
                "uang_pertanggungan_atas" => 800000000,
                "wilayah_satu_atas" => 1.320,
                "wilayah_satu_bawah" => 1.200,
                "wilayah_dua_atas" => 1.320,
                "wilayah_dua_bawah" => 1.200,
                "wilayah_tiga_atas" => 1.250,
                "wilayah_tiga_bawah" => 1.140
            ],
            [ 
                "asuransi_id" => 2,
                "kategori" => "Kategori 5",
                "uang_pertanggungan_bawah" => 800000000,
                "uang_pertanggungan_atas" => 0,
                "wilayah_satu_atas" => 1.160,
                "wilayah_satu_bawah" => 1.050,
                "wilayah_dua_atas" => 1.160,
                "wilayah_dua_bawah" => 1.050,
                "wilayah_tiga_atas" => 1.160,
                "wilayah_tiga_bawah" => 1.050
            ]
        ];

        foreach ($dataPersentasi as $val) {
            $record  = AsuransiPersentasiMobil::firstOrNew([
                    'asuransi_id' => $val['asuransi_id'],
                    'kategori' => $val['kategori'],
                ]);
            $record->uang_pertanggungan_bawah = $val['uang_pertanggungan_bawah'];
            $record->uang_pertanggungan_atas = $val['uang_pertanggungan_atas'];
            $record->wilayah_satu_atas = $val['wilayah_satu_atas'];
            $record->wilayah_satu_bawah = $val['wilayah_satu_bawah'];
            $record->wilayah_dua_atas = $val['wilayah_dua_atas'];
            $record->wilayah_dua_bawah = $val['wilayah_dua_bawah'];
            $record->wilayah_tiga_atas = $val['wilayah_tiga_atas'];
            $record->wilayah_tiga_bawah = $val['wilayah_tiga_bawah'];
            $record->save();
        }

        $dataRider = [
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 1,
                "pembayaran_persentasi" => 0.075,
                "pembayaran_persentasi_komersial" => 0.075
            ],
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 2,
                "pembayaran_persentasi" => 0.075,
                "pembayaran_persentasi_komersial" => 0.075
            ],
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 3,
                "pembayaran_persentasi" => 0.050,
                "pembayaran_persentasi_komersial" => 0.050
            ],
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 4,
                "pembayaran_persentasi" => 0.100,
                "pembayaran_persentasi_komersial" => 0.100
            ],
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 5,
                "pembayaran_persentasi" => 0.500,
                "pembayaran_persentasi_komersial" => 0.500
            ],
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 6,
                "pembayaran_persentasi" => 0.000,
                "pembayaran_persentasi_komersial" => 0.000
            ],
            [ 
                "asuransi_id" => 3,
                "rider_kendaraan_id" => 7,
                "pembayaran_persentasi" => 0.050,
                "pembayaran_persentasi_komersial" => 0.050
            ],

            [ 
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 1,
                "pembayaran_persentasi" => 0.075,
                "pembayaran_persentasi_komersial" => 0.075
            ],
            [ 
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 2,
                "pembayaran_persentasi" => 0.075,
                "pembayaran_persentasi_komersial" => 0.075
            ],
            [ 
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 3,
                "pembayaran_persentasi" => 0.050,
                "pembayaran_persentasi_komersial" => 0.050
            ],
            [ 
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 4,
                "pembayaran_persentasi" => 0.100,
                "pembayaran_persentasi_komersial" => 0.100
            ],
            [ 
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 5,
                "pembayaran_persentasi" => 0.500,
                "pembayaran_persentasi_komersial" => 0.500
            ],
            [
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 6,
                "pembayaran_persentasi" => 0.000,
                "pembayaran_persentasi_komersial" => 0.000
            ],
            [ 
                "asuransi_id" => 2,
                "rider_kendaraan_id" => 7,
                "pembayaran_persentasi" => 0.050,
                "pembayaran_persentasi_komersial" => 0.050
            ]
        ];

        foreach ($dataRider as $val) {
            $record  = AsuransiRiderMobil::firstOrNew([
                    'asuransi_id' => $val['asuransi_id'],
                    'rider_kendaraan_id'=> $val['rider_kendaraan_id'],
                ]);
            $record->pembayaran_persentasi = $val['pembayaran_persentasi'];
            $record->pembayaran_persentasi_komersial = $val['pembayaran_persentasi_komersial'];
            $record->save();
        }
    }
}
