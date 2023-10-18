<?php

namespace App\Http\Requests\Master\DataAsuransi;

use Illuminate\Foundation\Http\FormRequest;

class PertanggunganTambahanRequest extends FormRequest
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
            'name'        => 'required|string|max:255|unique:ref_pertanggungan_tambahan,name,'.$id,
        ];

        return $rules;
    }
}
