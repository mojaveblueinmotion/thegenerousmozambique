<?php

namespace App\Http\Requests\Master\Lainnya;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'title'        => 'required|string|max:255|unique:ref_faq,title,'.$id,
            'description'        => 'required',
        ];

        return $rules;
    }
}
