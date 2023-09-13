<?php

namespace App\Http\Requests\Master\AsuransiPerjalanan;

use Illuminate\Foundation\Http\FormRequest;

class JenisPerjalananRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'name'        => 'required|string|max:255|unique:ref_jenis_perjalanan,name,'.$id,
        ];

        return $rules;
    }
}
