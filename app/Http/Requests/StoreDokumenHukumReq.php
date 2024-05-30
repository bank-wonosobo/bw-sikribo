<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokumenHukumReq extends FormRequest
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
            'perihal' => ['required'],
            'tanggal' => ['required'],
            'tahun' => ['required'],
            'keterangan' => ['required'],
            'status' => ['required'],
            'jenis_dokumen_hukum_id' => ['required'],
            'file' => ['required', 'file', 'mimes:pdf']
        ];
    }
}
