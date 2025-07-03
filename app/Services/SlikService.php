<?php

namespace App\Services;

use App\Http\Requests\Slik\StoreSlikReq;
use App\Models\Slik;

interface SlikService {
    public function create(StoreSlikReq $req);
    public function generateNoRef(): array;
    public function setStatus(string $id, string $status): Slik;
    public function done(string $id): Slik;
    public function startSlik(string $is): Slik;
    public function generateBulkDoc(array $permohonanSlikIds): string;
    public function dequeue($permohonan_slik_id);
}
