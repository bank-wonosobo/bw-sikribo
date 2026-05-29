<?php

namespace App\Http\Requests\PemberkasanKredit;

use Illuminate\Foundation\Http\FormRequest;

class StorePemberkasanKreditReq extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nomor_register' => 'required|unique:pemberkasan_kredit,nomor_register',
            'kategori_id'    => 'required',
            'file'           => 'required|mimes:pdf',
        ];
    }
}
