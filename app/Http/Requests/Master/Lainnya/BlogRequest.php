<?php

namespace App\Http\Requests\Master\Lainnya;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'title'        => 'required|string|max:255|unique:ref_blog,title,'.$id,
            'description'        => 'required',
        ];

        return $rules;
    }
}
