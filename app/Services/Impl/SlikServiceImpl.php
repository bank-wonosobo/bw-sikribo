<?php

namespace App\Services\Impl;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\PermohonanSlik;
use App\Models\Slik;
use App\Services\SlikService;
use App\Traits\ManageFile;
use App\Traits\NumberToRoman;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SlikServiceImpl implements SlikService {
    use NumberToRoman;

    public function create(StoreSlikReq $req): array
    {
        try {
            DB::beginTransaction();
            $nama = $req->input('nama');
            $nik = $req->input('nik');
            $identitas_slik = $req->input('identitas_slik');
            $permohonan_slik_id = $req->input('permohonan_slik_id');
            $sliks = [];

            $nomer_ref_nomor =  $this->generateNoRef()['nomor'] + 1;


            for ($i=0; $i < 4; $i++) {

                if ($nama[$i] == null or $nik[$i] == null ) {
                    continue;
                }

                $slik = new Slik([
                    'nama' => $nama[$i],
                    'nik' => $nik[$i],
                    'identitas_slik' => $identitas_slik[$i],
                    'permohonan_slik_id' => $permohonan_slik_id,
                    'status' => 'PROSES',
                    'no_ref_slik' => $this->generateNoRef($nomer_ref_nomor)['nomor_ref'],
                ]);
                $slik->save();
                $sliks[] = $slik;
                $nomer_ref_nomor++;
            }

            DB::commit();
            return $sliks;

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }

    public function generateNoRef(int $nomor = null): array {

        $kode_bank = '600557';
        $bulan = Carbon::now()->month;
        $bulan_roman = $this->numberToRoman($bulan);
        $tahun = Carbon::now()->year;

        if ($nomor != null) {
            $nomor_ref = $nomor . '/' . $kode_bank . '/' . $bulan_roman . '/' . $tahun;
            array('nomor' => $nomor, 'nomor_ref' => $nomor_ref);
        }



        $slik = Slik::orderBy('no_ref_slik', 'DESC')->first();

        if($slik != null){

            $ref_terakhir = $slik->no_ref_slik;
            $explode_ref = explode('/', $ref_terakhir);
            $nomor_terakhir = $explode_ref[0];
            $bulan_roman_terakhir = $explode_ref[2];
            // $tahun_terakhir = end($explode_ref);
            $nomor_baru = 0;


            if ($bulan_roman == $bulan_roman_terakhir) {
                $nomor_baru = $nomor_terakhir + 1;
            } else {
                $nomor_baru = 1;
            }

            $nomor_ref = $nomor_baru . '/' . $kode_bank . '/' . $bulan_roman . '/' . $tahun;

            return  array('nomor' => $nomor_baru, 'nomor_ref' => $nomor_ref);
        }

        $nomor_ref = 1 . '/' . $kode_bank . '/' . $bulan_roman . '/' . $tahun;

        return array('nomor' => 1, 'nomor_ref' => $nomor_ref);
    }
}
