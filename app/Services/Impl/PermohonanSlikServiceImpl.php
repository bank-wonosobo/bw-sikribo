<?php

namespace App\Services\Impl;

use App\Exceptions\KodeSLIKNotSetException;
use App\Helper\AuthUser;
use App\Http\Requests\PermohonanSlik\StorePermohohonanSlikReq;
use App\Models\KodeSlik;
use App\Models\PermohonanSlik;
use App\Services\PermohonanSlikService;
use App\Traits\ManageFile;
use App\Traits\NumberToRoman;
use App\Traits\UploadTrait;
use Carbon\Carbon;

class PermohonanSlikServiceImpl implements PermohonanSlikService {

    use NumberToRoman, UploadTrait, ManageFile;


    function create(StorePermohohonanSlikReq $req, string $userid, string $pemohon): PermohonanSlik
    {
        $nomor = $req->input('nomor');
        $peruntukan_ideb = $req->input('peruntukan_ideb');

        $kode_slik = KodeSlik::where('user_id', $userid)->first();

        if ($kode_slik == null) {
            throw new KodeSLIKNotSetException("Kode SLIK belum diset");
        }

        $nomor_slik = $this->generateNomorPengajuan($nomor, $kode_slik->kode);
        $status = 'proses pengajuan';

        $permohonan = new PermohonanSlik([
            'tanggal' => Carbon::now(),
            'nomor' => $nomor_slik,
            'peruntukan_ideb' => $peruntukan_ideb,
            'status' => $status,
            'pemohon' => $pemohon
        ]);

        $permohonan->save();

        return $permohonan;

    }

    public function generateNomorPengajuan(string $nomor, string $kode_slik): string {

        $kode_bank = '600557';
        $bulanRoman = $this->numberToRoman(Carbon::now()->month);
        $tahun = Carbon::now()->year;

        $nomor_slik = $nomor . '/' . $kode_bank . '/' . $kode_slik . '/' . $bulanRoman . '/' . $tahun;

        return $nomor_slik;
    }

     public function addBerkas(string $id, $file)
    {
        $permohonan_slik = PermohonanSlik::find($id);

        $this->deleteFileExist($permohonan_slik);

        $file = $this->uploads($file, 'permohonan_slik/file');

        $permohonan_slik->berkas = $file;

        $permohonan_slik->save();

        return $permohonan_slik;
    }
}
