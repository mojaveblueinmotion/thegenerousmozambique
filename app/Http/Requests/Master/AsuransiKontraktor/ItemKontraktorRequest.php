<?php

namespace App\Http\Requests\Master\AsuransiKontraktor;

use Illuminate\Foundation\Http\FormRequest;

class ItemKontraktorRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->record->id ?? 0;
        $rules = [
            'name'        => 'required|string|max:255|unique:ref_item_kontraktor,name,'.$id,
            'section'        => 'required',
        ];

        return $rules;
    }
}
