<?php

namespace App\Services\Impl;

use App\Http\Requests\KomiteKredit\StoreKomiteKreditReq;
use App\Http\Requests\KomiteKredit\UpdateKomiteKreditReq;
use App\Models\KomiteKredit;
use App\Services\KomiteKreditService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;

class KomiteKreditServiceImpl implements KomiteKreditService
{
    use UploadTrait, ManageFile;

    public function create(StoreKomiteKreditReq $request): KomiteKredit
    {
        $data = new KomiteKredit([
            'nomor_register' => $request->input('nomor_register'),
            'kategori_id'    => $request->input('kategori_id'),
            'status'         => $request->input('status'),
        ]);
        $data->save();
        return $data;
    }

    public function update(UpdateKomiteKreditReq $request, string $id): KomiteKredit
    {
        $data = KomiteKredit::find($id);
        $data->nomor_register = $request->input('nomor_register');
        $data->kategori_id    = $request->input('kategori_id');
        $data->status         = $request->input('status');
        $data->save();
        return $data;
    }

    public function destroy(string $id)
    {
        $data = KomiteKredit::find($id);
        $this->deleteFileExist($data);
        KomiteKredit::where('id', $id)->delete();
    }

    public function addFile(string $id, $file)
    {
        $data = KomiteKredit::find($id);
        $this->deleteFileExist($data);
        $filename = strtoupper($data->nomor_register);
        $data->file = $this->uploads($file, 'komite_kredit/file', true, $filename);
        $data->save();
        return $data;
    }
}
