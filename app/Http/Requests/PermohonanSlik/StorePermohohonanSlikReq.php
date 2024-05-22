<?php

namespace App\Http\Requests\PermohonanSlik;

use Illuminate\Foundation\Http\FormRequest;

class StorePermohohonanSlikReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor' => ['required'],
            'peruntukan_ideb' => ['required'],
            'berkas' => ['required', 'file', 'mimes:pdf']
        ];
    }
}
