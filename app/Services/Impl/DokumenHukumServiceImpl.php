<?php

namespace App\Services\Impl;

use App\Http\Requests\StoreDokumenHukumReq;
use App\Http\Requests\UpdateDokumenHukumReq;
use App\Models\DokumenHukum;
use App\Services\DokumenHukumService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;

class DokumenHukumServiceImpl implements DokumenHukumService {
    use UploadTrait, ManageFile;

    public function create(StoreDokumenHukumReq $request): DokumenHukum
    {
         $dokumen = new DokumenHukum([
            'nomor' => $request->input('nomor'),
            'status' => $request->input('status'),
            'perihal' => $request->input('perihal'),
            'tanggal' => $request->input('tanggal'),
            'keterangan' => $request->input('keterangan'),
            'tahun' => $request->input('tahun'),
            'jenis_dokumen_hukum_id' => $request->input('jenis_dokumen_hukum_id'),

        ]);

        $dokumen->save();

        return $dokumen;
    }

    public function destroy(string $id)
    {

    }

    public function update(UpdateDokumenHukumReq $request, string $id): DokumenHukum
    {
        return new DokumenHukum();
    }

    public function addFile(string $id, $file)
    {

    }
}
