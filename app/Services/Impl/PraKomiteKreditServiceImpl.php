<?php

namespace App\Services\Impl;

use App\Http\Requests\PraKomiteKredit\StorePraKomiteKreditReq;
use App\Http\Requests\PraKomiteKredit\UpdatePraKomiteKreditReq;
use App\Models\PraKomiteKredit;
use App\Services\PraKomiteKreditService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;

class PraKomiteKreditServiceImpl implements PraKomiteKreditService
{
    use UploadTrait, ManageFile;

    public function create(StorePraKomiteKreditReq $request): PraKomiteKredit
    {
        $data = new PraKomiteKredit([
            'nomor_register' => $request->input('nomor_register'),
            'kategori_id'    => $request->input('kategori_id'),
        ]);
        $data->save();
        return $data;
    }

    public function update(UpdatePraKomiteKreditReq $request, string $id): PraKomiteKredit
    {
        $data = PraKomiteKredit::find($id);
        $data->nomor_register = $request->input('nomor_register');
        $data->kategori_id    = $request->input('kategori_id');
        $data->save();
        return $data;
    }

    public function destroy(string $id)
    {
        $data = PraKomiteKredit::find($id);
        $this->deleteFileExist($data);
        PraKomiteKredit::where('id', $id)->delete();
    }

    public function addFile(string $id, $file)
    {
        $data = PraKomiteKredit::find($id);
        $this->deleteFileExist($data);
        $filename = strtoupper($data->nomor_register);
        $data->file = $this->uploads($file, 'pra_komite_kredit/file', true, $filename);
        $data->save();
        return $data;
    }
}
