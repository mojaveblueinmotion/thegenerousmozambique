<?php

namespace App\Http\Requests\Master\AsuransiMotor;

use Illuminate\Foundation\Http\FormRequest;

class AsuransiPersentasiMotorRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'kategori' => 'required',
            'uang_pertanggungan_bawah' => 'required',
            'uang_pertanggungan_atas' => 'required',
            'wilayah_satu_atas' => 'required',
            'wilayah_satu_bawah' => 'required',
            'wilayah_dua_atas' => 'required',
            'wilayah_dua_bawah' => 'required',
            'wilayah_tiga_atas' => 'required',
            'wilayah_tiga_bawah' => 'required',
        ];

        return $rules;
    }
}
