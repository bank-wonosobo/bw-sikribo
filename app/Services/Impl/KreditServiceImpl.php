<?php

namespace App\Services\Impl;

use App\Http\Requests\Kredit\StoreKreditReq;
use App\Http\Requests\Kredit\UpdateKreditReq;
use App\Models\Kredit;
use App\Services\KreditService;
use App\Traits\ManageFile;
use App\Traits\UploadTrait;

class KreditServiceImpl implements KreditService {
    use UploadTrait, ManageFile;

    public function create(StoreKreditReq $request): Kredit
    {

        $kredit = new Kredit([
            'no_kredit' => $request->input('no_kredit'),
            'nama_peminjam' => $request->input('nama_peminjam'),
            'tanggal_akad' => $request->input('tanggal_akad'),
            'kategori_id' => $request->input('kategori_id'),
            'no_jaminan' => $request->input('no_jaminan'),
            'jenis_jaminan_id' => $request->input('jenis_jaminan_id'),
            'status_pengikatan' => $request->input('status_pengikatan'),
        ]);

        $kredit->save();

        return $kredit;
    }

    public function destroy(string $id)
    {
        $kredit = Kredit::find($id);

        $this->deleteFileExist($kredit);

        Kredit::where('id', $id)->delete();
    }

    public function update(UpdateKreditReq $request, string $id): Kredit
    {
        $kredit = Kredit::find($id);
        $kredit->no_kredit = $request->input('no_kredit');
        $kredit->nama_peminjam = $request->input('nama_peminjam');
        $kredit->tanggal_akad = $request->input('tanggal_akad');
        $kredit->kategori_id = $request->input('kategori_id');
        $kredit->no_jaminan = $request->input('no_jaminan');
        $kredit->jenis_jaminan_id = $request->input('jenis_jaminan_id');
        $kredit->save();

        return $kredit;

    }

    public function addFileKredit(string $id, $file)
    {
        $kredit = Kredit::find($id);

        $this->deleteFileExist($kredit);

        $filename = strtoupper($kredit->nama_peminjam) . '_' . $kredit->no_kredit;

        $file = $this->uploads($file, 'perjanjian_kredit/file', true, $filename);

        $kredit->file = $file;

        $kredit->save();

        return $kredit;
    }
}
