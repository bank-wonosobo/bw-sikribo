<?php

namespace App\Services\Impl;

use App\Http\Requests\KodeSlik\StoreKodeSlikReq;
use App\Models\KodeSlik;
use App\Services\KodeSlikService;

class KodeSlikServiceImpl implements KodeSlikService {
    public function setCode(StoreKodeSlikReq $req, $userid): KodeSlik
    {
        $kode = $req->input('kode');

        $kode = KodeSlik::updateOrCreate(
            ['user_id' => $userid],
            ['kode' => $kode]
        );


        return $kode;
    }
}
