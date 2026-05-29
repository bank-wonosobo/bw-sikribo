<?php

namespace App\Services;

use App\Http\Requests\KomiteKredit\StoreKomiteKreditReq;
use App\Http\Requests\KomiteKredit\UpdateKomiteKreditReq;
use App\Models\KomiteKredit;

interface KomiteKreditService
{
    public function create(StoreKomiteKreditReq $request): KomiteKredit;
    public function update(UpdateKomiteKreditReq $request, string $id): KomiteKredit;
    public function destroy(string $id);
    public function addFile(string $id, $file);
}
