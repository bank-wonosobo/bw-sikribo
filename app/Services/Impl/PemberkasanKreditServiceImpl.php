<?php

namespace App\Services\Impl;

use App\Http\Requests\PemberkasanKredit\StorePemberkasanKreditReq;
use App\Http\Requests\PemberkasanKredit\UpdatePemberkasanKreditReq;
use App\Models\PemberkasanKredit;
use App\Services\PemberkasanKreditService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;

class PemberkasanKreditServiceImpl implements PemberkasanKreditService
{
    use UploadTrait, ManageFile;

    public function create(StorePemberkasanKreditReq $request): PemberkasanKredit
    {
        $data = new PemberkasanKredit([
            'nomor_register' => $request->input('nomor_register'),
            'kategori_id'    => $request->input('kategori_id'),
        ]);
        $data->save();
        return $data;
    }

    public function update(UpdatePemberkasanKreditReq $request, string $id): PemberkasanKredit
    {
        $data = PemberkasanKredit::find($id);
        $data->nomor_register = $request->input('nomor_register');
        $data->kategori_id    = $request->input('kategori_id');
        $data->save();
        return $data;
    }

    public function destroy(string $id)
    {
        $data = PemberkasanKredit::find($id);
        $this->deleteFileExist($data);
        PemberkasanKredit::where('id', $id)->delete();
    }

    public function addFile(string $id, $file)
    {
        $data = PemberkasanKredit::find($id);
        $this->deleteFileExist($data);
        $filename = strtoupper($data->nomor_register);
        $data->file = $this->uploads($file, 'pemberkasan_kredit/file', true, $filename);
        $data->save();
        return $data;
    }
}
