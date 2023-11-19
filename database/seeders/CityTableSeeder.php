<?php

namespace Database\Seeders;

use App\Models\Master\Geo\City;
use App\Models\Master\Geo\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/seeders/json/city.json');
        $json = File::get($path);
        $data = json_decode($json);

        $this->generate($data);

        $path_gempabumi = base_path('database/seeders/json/zona_gempabumi.json');
        $json_gempabumi = File::get($path_gempabumi);
        $data_gempabumi = json_decode($json_gempabumi);

        $this->generateZona($data_gempabumi);
    }

    public function generate($data)
    {
        foreach ($data as $val) {
            $city = City::where('code', $val->code)
                ->first();
            if (!$city) {
                $city = new City;
                $province   = Province::where('code', $val->parent_code)
                    ->first();
                if (!$province) {
                    continue;
                }
                $city->province_id  = $province->id;
            }
            $city->code         = $val->code;
            $city->name         = $val->name;
            $city->created_by   = 1;
            $city->created_at   = \Carbon\Carbon::now();
            $city->save();
        }
    }

    public function generateZona($data_gempabumi)
    {
        foreach ($data_gempabumi as $value) {
            if(!empty($value->daerah)){
                $city = City::where('name', $value->daerah)->first();
                if ($city) {
                    $city->zona         = $value->zona ?? null;
                    $city->updated_at   = \Carbon\Carbon::now();
                    $city->save();
                }
            }else{
                dd($value);
            }
            
        }
    }
}
