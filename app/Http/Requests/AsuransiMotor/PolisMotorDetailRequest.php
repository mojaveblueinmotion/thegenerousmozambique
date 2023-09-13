<?php

namespace App\Http\Requests\AsuransiMotor;

use Illuminate\Foundation\Http\FormRequest;

class PolisMotorDetailRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'rincian_modifikasi' => 'required',
            'nilai_modifikasi' => 'required',
            'tipe' => 'required',
            'nilai_motor' => 'required',
            'nilai_pertanggungan' => 'required',
            'pemakaian' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'no_plat' => 'required',
            'merk_id' => 'required',
            'tahun_id' => 'required',
            'tipe_id' => 'required',
            'seri_id' => 'required',
            'tipe_kendaraan_id' => 'required',
            'kode_plat_id' => 'required',
            'kode_plat' => 'required',
            'tipe_pemakaian_id' => 'required',
            'luas_pertanggungan_id' => 'required',
            'kondisi_kendaraan_id' => 'required',
            'nama' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'village' => 'required',
            'alamat' => 'required',
            'warna' => 'required',
            'keterangan' => 'required',
            'no_chasis' => 'required',
            'no_mesin' => 'required',
        ];

        return $rules;
    }
}
