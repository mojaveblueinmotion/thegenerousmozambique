<?php

namespace App\Http\Requests\Master\AsuransiKontraktor;

use Illuminate\Foundation\Http\FormRequest;

class SubsoilRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'name'        => 'required|string|max:255|unique:ref_subsoil,name,'.$id,
        ];

        return $rules;
    }
}
