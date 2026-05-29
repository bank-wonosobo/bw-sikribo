<?php

namespace App\Http\Requests\AssesmentKredit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssesmentKreditReq extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nomor_register' => 'required|unique:assesment_kredit,nomor_register,' . $this->route('id'),
            'nomor_kredit'   => 'required',
            'kategori_id'    => 'required',
        ];
    }
}
