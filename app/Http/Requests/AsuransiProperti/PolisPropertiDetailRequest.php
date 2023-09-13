<?php

namespace App\Http\Requests\AsuransiProperti;

use Illuminate\Foundation\Http\FormRequest;

class PolisPropertiDetailRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'nilai_bangunan' => 'required',
            'nilai_isi' => 'required',
            'nilai_mesin' => 'required',
            'nilai_stok' => 'required',
            'nilai_pertanggungan' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'alamat' => 'required',
            'okupasi_id' => 'required',
            'status_lantai' => 'required',
            'status_bangunan' => 'required',
            'status_banjir' => 'required',
            'status_klaim' => 'required',
        ];

        return $rules;
    }
}
