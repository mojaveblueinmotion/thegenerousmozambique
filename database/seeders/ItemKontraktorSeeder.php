<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiKontraktor\ItemKontraktor;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\Master\DataAsuransi\IntervalPembayaran;
use Illuminate\Database\Seeder;

class ItemKontraktorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // BAGIAN 1
            [ 
                "name" => "Pekerjaan kontrak (pekerjaan tetap dan sementara termasuk
                semua bahan yang termasuk di dalamnya)",
                "section" => 1,
            ],
            [ 
                "name" => "Nilai Kontrak",
                "section" => 1,
            ],
            [ 
                "name" => "Bahan atau barang yang dipasok oleh Prinsipal",
                "section" => 1,
            ],
            [ 
                "name" => "Perlengkapan dan peralatan konstruksi",
                "section" => 1,
            ],
            [ 
                "name" => "Pembersihan puing",
                "section" => 1,
            ],
            [ 
                "name" => "Total uang pertanggungan yang akan diasuransikan pada Bagian I",
                "section" => 1,
            ],
            [ 
                "name" => "Resiko khusus yang akan diasuransikan",
                "section" => 1,
            ],
            [ 
                "name" => "Badai, topan, banjir, genangan, tanah longsor",
                "section" => 1,
            ],
            // BAGIAN 2
            [ 
                "name" => "Cedera fisik",
                "section" => 2,
            ],
            [ 
                "name" => "Setiap orang",
                "section" => 2,
            ],
            [ 
                "name" => "Total",
                "section" => 2,
            ],
            [ 
                "name" => "Kerusakan Properti",
                "section" => 2,
            ],
            [ 
                "name" => "Batas total pada bagian II",
                "section" => 2,
            ],
        ];

        foreach ($data as $val) {
            $record          = ItemKontraktor::firstOrNew(['name' => $val['name']]);
            $record->section = $val['section'];
            $record->save();
        }
    }
}
