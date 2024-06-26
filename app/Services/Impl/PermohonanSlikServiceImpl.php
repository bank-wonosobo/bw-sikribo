<?php

namespace App\Services\Impl;

use App\Exceptions\KodeSLIKNotSetException;
use App\Exceptions\NomorSLIKCanotSameException;
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


        $nomor_slik = $this->generateNomorPengajuan($kode_slik->kode);

        $status = 'BELUM INPUT DEBITUR';

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

    public function generateNomorPengajuan(string $kode_slik): string {

        $kode_bank = '600557';
        $bulan_roman = $this->numberToRoman(Carbon::now()->month);
        $tahun = Carbon::now()->year;

        $permohonan_slik = PermohonanSlik::where('nomor','like', '%' . $kode_slik . '%')->orderBy('created_at', 'DESC')->first();

        if($permohonan_slik != null){

            $ref_terakhir = $permohonan_slik->nomor;
            $explode_nomor = explode('/', $ref_terakhir);
            $nomor_terakhir = $explode_nomor[0];
            $bulan_roman_terakhir = $explode_nomor[3];
            // $tahun_terakhir = end($explode_ref);
            $nomor_baru = 0;


            if ($bulan_roman == $bulan_roman_terakhir) {
                $nomor_baru = $nomor_terakhir + 1;
            } else {
                $nomor_baru = 1;
            }

            $nomer = str_pad($nomor_baru, 3, '0', STR_PAD_LEFT);

            return $nomer . '/' . $kode_bank . '/' . $kode_slik  . '/' . $bulan_roman . '/' . $tahun;

        }

        $nomer = str_pad(1, 3, '0', STR_PAD_LEFT);

        $nomor_slik = $nomer . '/' . $kode_bank . '/' . $kode_slik . '/' . $bulan_roman . '/' . $tahun;

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
