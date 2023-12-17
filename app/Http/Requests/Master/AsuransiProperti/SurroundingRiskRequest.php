<?php

namespace App\Http\Requests\Master\AsuransiProperti;

use Illuminate\Foundation\Http\FormRequest;

class SurroundingRiskRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'name'        => 'required|string|max:255|unique:ref_surrounding_risk,name,'.$id,
            'tingkat_resiko' => 'required|numeric|min:0|max:5'
        ];

        return $rules;
    }
}
