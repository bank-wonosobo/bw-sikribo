<?php

namespace App\Services;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\Slik;

interface SlikService {
    public function create(StoreSlikReq $req): Slik;
    public function destroy(string $id);
    public function monthlydestroy();
}
