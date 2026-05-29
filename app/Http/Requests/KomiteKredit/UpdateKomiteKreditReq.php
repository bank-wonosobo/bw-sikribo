<?php

namespace App\Http\Requests\KomiteKredit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKomiteKreditReq extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nomor_register' => 'required|unique:komite_kredit,nomor_register,' . $this->route('id'),
            'kategori_id'    => 'required',
            'status'         => 'required|in:Disetujui,Ditolak,Disetujui Tidak Sesuai Permohonan',
        ];
    }
}
