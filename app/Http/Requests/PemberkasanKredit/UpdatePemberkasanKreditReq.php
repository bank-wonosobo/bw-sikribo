<?php

namespace App\Http\Requests\PemberkasanKredit;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemberkasanKreditReq extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nomor_register' => 'required|unique:pemberkasan_kredit,nomor_register,' . $this->route('id'),
            'kategori_id'    => 'required',
        ];
    }
}
