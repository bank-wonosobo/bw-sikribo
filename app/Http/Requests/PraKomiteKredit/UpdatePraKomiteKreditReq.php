<?php

namespace App\Http\Requests\PraKomiteKredit;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePraKomiteKreditReq extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nomor_register' => 'required|unique:pra_komite_kredit,nomor_register,' . $this->route('id'),
            'kategori_id'    => 'required',
        ];
    }
}
