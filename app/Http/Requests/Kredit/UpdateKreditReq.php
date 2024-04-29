<?php

namespace App\Http\Requests\Kredit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKreditReq extends FormRequest
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
            'no_kredit' => ['required'],
            'nama_peminjam' => ['required'],
            'kategori_id' => ['required'],
            'tanggal_akad' => ['required']
        ];
    }
}
