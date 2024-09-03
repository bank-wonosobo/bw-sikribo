<?php

namespace App\Imports;

use App\Exceptions\JenisJaminanNotFoundException;
use App\Exceptions\KategoriKreditNotFoundException;
use App\Models\JenisJaminan;
use App\Models\KategoriKredit;
use App\Models\Kredit;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class KreditImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        if ($row['no_pinjaman'] != null or $row['no_penyimpanan'] != null) {
            $idKredit = $this->getJenisKreditId($row['no_pinjaman'], $row['no']);
            $jenisJaminan = $this->getJenisJaminanId($row['no_penyimpanan'], $row['no']);

            return Kredit::updateOrCreate([
                'no_kredit' => $row['no_pinjaman']
            ], [
                'nama_peminjam' => $row['nama'],
                'tanggal_akad' => Carbon::parse($row['tanggal_akad']),
                'kategori_id' => $idKredit,
                'no_jaminan' => $row['no_penyimpanan'],
                'jenis_jaminan_id' => $jenisJaminan,
                'status_pengikatan' => $row['status_pengikatan'],
                'keterangan' => $row['keterangan'],
            ]);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    private function getJenisKreditId($nomer_kredit, $baris) {
        $nomer_kredit_arr = explode('.', $nomer_kredit);
        $kode_kredit = $nomer_kredit_arr[1] ?? null;

        if ($kode_kredit == null) {
            throw new KategoriKreditNotFoundException("Terdapat nomer kredit yang kosong atau tidak sesuai , pada baris table (No) ke-" . $baris );
        }

        $kategoriKredit = KategoriKredit::where('kode', $kode_kredit)->first();

        if ($kategoriKredit == null) {
            throw new KategoriKreditNotFoundException("Jenis kredit tidak ditemukan, terdapat nomer kredit yang tidak sesuai pada baris table (No) ke-" . $baris );
        }

        return $kategoriKredit->id;
    }

    private function getJenisJaminanId($no_penyimpanan, $baris) {
        $no_penyimpanan_arr = explode(' ', $no_penyimpanan);
        $nama_jaminan = $no_penyimpanan_arr[1] ?? null;

        if ($nama_jaminan == null) {
            throw new JenisJaminanNotFoundException("Terdapat nomer penyimpanan yang kosong , pada baris table (No) ke-" . $baris );
        }

        if ($nama_jaminan == 'KPR') {
            $nama_jaminan = 'SHM';
        }

        if ($nama_jaminan == 'LOS') {
            $nama_jaminan = 'LOS KIOS';
        }

        if ($nama_jaminan == 'KUR') {
            $nama_jaminan = 'KURDA';
        }

        if ($nama_jaminan == 'SF') {
            $nama_jaminan = 'SERTIFIKAT';
        }

        $jenisJaminan = JenisJaminan::where('nama', $nama_jaminan)->first();

        if ($jenisJaminan == null) {
            throw new JenisJaminanNotFoundException("Jenis jaminan tidak ditemukan, terdapat nomer penyimpanan yang tidak sesuai pada baris table (No) ke-" . $baris );
        }

        return $jenisJaminan->id;
    }
}
