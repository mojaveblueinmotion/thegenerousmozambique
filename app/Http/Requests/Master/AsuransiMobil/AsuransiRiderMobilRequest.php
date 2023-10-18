<?php

namespace App\Http\Requests\Master\AsuransiMobil;

use Illuminate\Foundation\Http\FormRequest;

class AsuransiRiderMobilRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'pembayaran_persentasi' => 'required',
            'pembayaran_persentasi_komersial' => 'required',
            'rider_kendaraan_id' => 'required',
        ];

        return $rules;
    }
}
