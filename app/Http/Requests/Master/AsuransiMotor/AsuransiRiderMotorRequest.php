<?php

namespace App\Http\Requests\Master\AsuransiMotor;

use Illuminate\Foundation\Http\FormRequest;

class AsuransiRiderMotorRequest extends FormRequest
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
