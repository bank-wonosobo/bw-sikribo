<?php

namespace App\Services;

use App\Http\Requests\Kredit\StoreKreditReq;
use App\Http\Requests\Kredit\UpdateKreditReq;
use App\Models\Kredit;

interface KreditService {
    public function create(StoreKreditReq $request): Kredit;
    public function destroy(string $id);
    public function update(UpdateKreditReq $request, string $id): Kredit;
    public function addFileKredit(string $id, $file);
}
