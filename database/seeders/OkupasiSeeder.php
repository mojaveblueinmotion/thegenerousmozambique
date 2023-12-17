<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\Okupasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class OkupasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/seeders/json/okupasi.json');
        $json = File::get($path);
        $data = json_decode($json, true);

        foreach ($data as $val) {
            $record          = Okupasi::firstOrNew(['name' => $val['name']]);
            $record->code = $val['code'] ?? null;
            $record->tarif_konstruksi_satu = $val['tarif_konstruksi_satu'] ?? 0;
            $record->tarif_konstruksi_dua = $val['tarif_konstruksi_dua'] ?? 0;
            $record->tarif_konstruksi_tiga = $val['tarif_konstruksi_tiga'] ?? 0;
            $record->save();
        }
    }
}
