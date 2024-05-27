<?php

namespace App\Services;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\Slik;

interface SlikService {
    public function create(StoreSlikReq $req): array;
    public function generateNoRef(): array;
    public function setStatus(string $id, string $status): Slik;
}
