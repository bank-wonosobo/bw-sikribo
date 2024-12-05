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
        $dokumen_hukum = DokumenHukum::find($id);
        $dokumen_hukum->nomor = $request->input('nomor');
        $dokumen_hukum->status = $request->input('status');
        $dokumen_hukum->perihal = $request->input('perihal');
        $dokumen_hukum->tanggal = $request->input('tanggal');
        $dokumen_hukum->keterangan = $request->input('keterangan');
        $dokumen_hukum->tahun = $request->input('tahun');
        $dokumen_hukum->jenis_dokumen_hukum_id = $request->input('jenis_dokumen_hukum_id');
        $dokumen_hukum->save();
        return $dokumen_hukum;
    }

    public function addFile(string $id, $file)
    {
        $dokumen_hukum = DokumenHukum::find($id);

        $this->deleteFileExist($dokumen_hukum);

        $file = $this->uploads($file, 'dokumen_hukum/file');

        $dokumen_hukum->file = $file;

        $dokumen_hukum->save();

        return $dokumen_hukum;
    }
}
