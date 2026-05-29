<?php

namespace App\Http\Requests\KomiteKredit;

use Illuminate\Foundation\Http\FormRequest;

class StoreKomiteKreditReq extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nomor_register' => 'required|unique:komite_kredit,nomor_register',
            'kategori_id'    => 'required',
            'status'         => 'required|in:Disetujui,Ditolak,Disetujui Tidak Sesuai Permohonan',
            'file'           => 'required|mimes:pdf',
        ];
    }
}
