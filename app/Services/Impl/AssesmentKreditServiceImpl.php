<?php

namespace App\Services\Impl;

use App\Http\Requests\AssesmentKredit\StoreAssesmentKreditReq;
use App\Http\Requests\AssesmentKredit\UpdateAssesmentKreditReq;
use App\Models\AssesmentKredit;
use App\Services\AssesmentKreditService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;

class AssesmentKreditServiceImpl implements AssesmentKreditService
{
    use UploadTrait, ManageFile;

    public function create(StoreAssesmentKreditReq $request): AssesmentKredit
    {
        $data = new AssesmentKredit([
            'nomor_register' => $request->input('nomor_register'),
            'nomor_kredit'   => $request->input('nomor_kredit'),
            'kategori_id'    => $request->input('kategori_id'),
        ]);
        $data->save();
        return $data;
    }

    public function update(UpdateAssesmentKreditReq $request, string $id): AssesmentKredit
    {
        $data = AssesmentKredit::find($id);
        $data->nomor_register = $request->input('nomor_register');
        $data->nomor_kredit   = $request->input('nomor_kredit');
        $data->kategori_id    = $request->input('kategori_id');
        $data->save();
        return $data;
    }

    public function destroy(string $id)
    {
        $data = AssesmentKredit::find($id);
        $this->deleteFileExist($data);
        AssesmentKredit::where('id', $id)->delete();
    }

    public function addFile(string $id, $file)
    {
        $data = AssesmentKredit::find($id);
        $this->deleteFileExist($data);
        $filename = strtoupper($data->nomor_register);
        $data->file = $this->uploads($file, 'assesment_kredit/file', true, $filename);
        $data->save();
        return $data;
    }
}
