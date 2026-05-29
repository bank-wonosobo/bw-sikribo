<?php

namespace App\Services;

use App\Http\Requests\PraKomiteKredit\StorePraKomiteKreditReq;
use App\Http\Requests\PraKomiteKredit\UpdatePraKomiteKreditReq;
use App\Models\PraKomiteKredit;

interface PraKomiteKreditService
{
    public function create(StorePraKomiteKreditReq $request): PraKomiteKredit;
    public function update(UpdatePraKomiteKreditReq $request, string $id): PraKomiteKredit;
    public function destroy(string $id);
    public function addFile(string $id, $file);
}
