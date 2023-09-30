<?php

namespace App\Http\Requests\Master\AsuransiMobil;

use Illuminate\Foundation\Http\FormRequest;

class AsuransiMobilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'name'        => 'required|string|max:255|unique:ref_asuransi_mobil,name,'.$id,
            'perusahaan_asuransi_id' => 'required',
            'interval_pembayaran_id' => 'required',
            'kategori_asuransi_id' => 'required',
            'call_center' => 'required',
            'wilayah_satu_batas_atas' => 'required',
            'wilayah_satu_batas_bawah' => 'required',
            'wilayah_dua_batas_atas' => 'required',
            'wilayah_dua_batas_bawah' => 'required',
            'wilayah_tiga_batas_atas' => 'required',
            'wilayah_tiga_batas_bawah' => 'required',
        ];

        return $rules;
    }
    
}
