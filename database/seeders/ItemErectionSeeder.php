<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiErection\ItemErection;
use App\Models\Master\AsuransiKontraktor\ItemKontraktor;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Models\Master\DataAsuransi\IntervalPembayaran;
use Illuminate\Database\Seeder;

class ItemErectionSeeder extends Seeder
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
                "name" => "Benda yang akan didirikan",
                "section" => 1,
            ],
            [ 
                "name" => "Biaya pengiriman",
                "section" => 1,
            ],
            [ 
                "name" => "Bea dan kepabeanan",
                "section" => 1,
            ],
            [ 
                "name" => "Biaya pendirian",
                "section" => 1,
            ],
            [ 
                "name" => "Pekerjaan teknis sipil",
                "section" => 1,
            ],
            [ 
                "name" => "Peralatan konstruksi/pendirian",
                "section" => 1,
            ],
            [ 
                "name" => "Pembersihan puing",
                "section" => 1,
            ],
            [ 
                "name" => "Properti yang berada di tempat prinsipal atau di lokasi miliki
                prinsipal atau dibawah perawatan, pengawasan, pengendalian
                (batas ganti rugi lihat memo 4 pada Polis)",
                "section" => 1,
            ],
            [ 
                "name" => "Gempa bumi, gunung berapi, tsunami",
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
        ];

        foreach ($data as $val) {
            $record          = ItemErection::firstOrNew(['name' => $val['name']]);
            $record->section = $val['section'];
            $record->save();
        }
    }
}
