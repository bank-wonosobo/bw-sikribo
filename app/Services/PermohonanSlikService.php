<?php

namespace App\Services;

use App\Helper\AuthUser;
use App\Http\Requests\PermohonanSlik\StorePermohohonanSlikReq;
use App\Models\PermohonanSlik;

interface PermohonanSlikService {
    public function create(StorePermohohonanSlikReq $req,  string $userid, string $pemohon): PermohonanSlik;
    public function generateNomorPengajuan(string $kode_slik): string;
    public function addBerkas(string $id, $file);

}
