<?php

namespace App\Services;

use App\Http\Requests\KodeSlik\StoreKodeSlikReq;
use App\Models\KodeSlik;

interface KodeSlikService {
    public function setCode(StoreKodeSlikReq $req, $userid): KodeSlik;
}
