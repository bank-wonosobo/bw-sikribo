<?php

namespace App\Services;

use App\Http\Requests\Kredit\StoreKreditReq;
use App\Http\Requests\Kredit\UpdateKreditReq;
use App\Models\Kredit;

interface KreditService {
    public function create(StoreKreditReq $request): Kredit;
    public function destroy(int $id);
    public function update(UpdateKreditReq $request, int $id): Kredit;
    public function addFileKredit(int $id, $file);
}
