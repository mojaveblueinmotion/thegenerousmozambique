<?php

namespace App\Http\Requests\CustomModule;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'title'        => 'required|string|max:255|unique:trans_custom_module,title,'.$id,
            'status'        => 'required',
            // 'description'        => 'required',
            // 'details.*.type' => 'required',
            // 'details.*.required' => 'required',
            // 'details.*.judul'   => 'required',
            // 'details.*.value'     => 'required',
            // 'details.*.informasi'     => 'required',
        ];

        return $rules;
    }
}
