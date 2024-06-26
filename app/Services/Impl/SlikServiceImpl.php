<?php

namespace App\Services\Impl;

use App\Exceptions\AntrianIsNullException;
use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\AntrianPermohonanSlik;
use App\Models\PermohonanSlik;
use App\Models\Slik;
use App\Services\SlikService;
use App\Traits\ManageFile;
use App\Traits\NumberToRoman;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
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
                    'status' => 'PROSES PENGAJUAN',
                    'no_ref_slik' => $this->generateNoRef($nomer_ref_nomor)['nomor_ref'],
                ]);
                $slik->save();
                $sliks[] = $slik;
                sleep(1);
                $nomer_ref_nomor++;
            }

            $status = 'PROSES PENGAJUAN';

            $permohonan_slik = PermohonanSlik::find($permohonan_slik_id);
            $permohonan_slik->status = $status;
            $permohonan_slik->save();

            // tambah antrian
            $this->enqueue($permohonan_slik_id);

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

        $slik = Slik::where('no_ref_slik', 'like', '%' . $bulan_roman . '/' . $tahun . '%')->orderBy('created_at', 'DESC')->first();

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

            $nomer = str_pad($nomor_baru, 3, '0', STR_PAD_LEFT);

            $nomor_ref = $nomer . '/' . $kode_bank . '/' . $bulan_roman . '/' . $tahun;

            return  array('nomor' => $nomor_baru, 'nomor_ref' => $nomor_ref);
        }

        $nomer = str_pad(1, 3, '0', STR_PAD_LEFT);

        $nomor_ref = $nomer . '/' . $kode_bank . '/' . $bulan_roman . '/' . $tahun;

        return array('nomor' => 1, 'nomor_ref' => $nomor_ref);
    }

    public function setStatus(string $id, string $status): Slik
    {
        $slik = Slik::find($id);
        $slik->status = $status;
        $slik->save();

        return $slik;
    }

    public function done(string $id): Slik
    {
        try {
            $petugas_slik = Auth::user()->name;

            DB::beginTransaction();

            $slik = Slik::find($id);
            $slik->status = 'SELESAI';
            $slik->petugas_slik = $petugas_slik;
            $slik->save();

            $totalSlikDone = Slik::where('permohonan_slik_id', $slik->permohonan_slik_id)->where('status', 'SELESAI')->count();
            $totalSlikPermohonan = Slik::where('permohonan_slik_id', $slik->permohonan_slik_id)->count();

            if ($totalSlikDone == $totalSlikPermohonan) {
                $slik->status = 'SELESAI';
                $slik->save();

                $permohonanSlik = PermohonanSlik::find($slik->permohonan_slik_id);
                $permohonanSlik->status = 'SELESAI';
                $permohonanSlik->save();

                $this->dequeue($permohonanSlik->id);
            }

            DB::commit();

            return $slik;

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }

    public function startSlik(string $id): Slik
    {

        $petugas_slik = Auth::user()->name;

        $slik = Slik::find($id);
        $slik->status = 'PROSES SLIK';
        $slik->petugas_slik = $petugas_slik;
        $slik->save();

        return $slik;
    }

    private function dequeue($permohonan_slik_id) {
        $antrian = AntrianPermohonanSlik::where('permohonan_slik_id', $permohonan_slik_id)->first();

        if ($antrian != null) {
            $listAntrian = AntrianPermohonanSlik::where('nomor_antrian', '>', $antrian->nomor_antrian)->get();

            try {
                DB::beginTransaction();
                $antrian->delete();

                foreach($listAntrian as $item) {
                    // $ittantrian = AntrianPermohonanSlik::find($item->id);
                    $nomor_baru =  $item->nomor_antrian - 1;
                    $item->nomor_antrian = $nomor_baru;
                    $item->save();
                }
                DB::commit();

            } catch (\Exception $th) {
                DB::rollBack();
                throw new Exception($th);
            }
        }
    }


    private function enqueue($permohonan_slik_id): AntrianPermohonanSlik
    {
        $antrian_terakhir = AntrianPermohonanSlik::orderBy('nomor_antrian', 'DESC')->first();

        if ($antrian_terakhir != null) {
            $nomor_antrian = $antrian_terakhir->nomor_antrian + 1;

            $antrian = new AntrianPermohonanSlik();
            $antrian->permohonan_slik_id = $permohonan_slik_id;
            $antrian->nomor_antrian = $nomor_antrian;
            $antrian->save();

            return $antrian;
        }

        $antrian = new AntrianPermohonanSlik();
        $antrian->permohonan_slik_id = $permohonan_slik_id;
        $antrian->nomor_antrian = 1;
        $antrian->save();

        return $antrian;


    }
}
