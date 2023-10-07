<?php

namespace App\Http\Requests\Master\DataAsuransi;

use Illuminate\Foundation\Http\FormRequest;

class RiderKendaraanLainnyaRequest extends FormRequest
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
            'name'        => 'required|string|max:255|unique:ref_rider_kendaraan_lainnya,name,'.$id,
            'persentasi_pembayaran' => 'required',
        ];

        return $rules;
    }
}
