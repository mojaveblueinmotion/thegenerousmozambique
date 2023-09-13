<?php

namespace App\Http\Requests\AsuransiPerjalanan;

use Illuminate\Foundation\Http\FormRequest;

class PolisPerjalananDetailRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'pekerjaan' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',

            'from_province_id' => 'required',
            'from_city_id' => 'required',
            'destination_province_id' => 'required',
            'destination_city_id' => 'required',
            'ahli_waris' => 'required',
            'hubungan_ahli_waris' => 'required',
        ];

        return $rules;
    }
}
