<?php

namespace App\Http\Requests\Master\AsuransiProperti;

use Illuminate\Foundation\Http\FormRequest;

class KonstruksiPropertiRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'name'        => 'required',
        ];

        return $rules;
    }
}
