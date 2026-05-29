<?php

namespace App\Services;

use App\Http\Requests\PemberkasanKredit\StorePemberkasanKreditReq;
use App\Http\Requests\PemberkasanKredit\UpdatePemberkasanKreditReq;
use App\Models\PemberkasanKredit;

interface PemberkasanKreditService
{
    public function create(StorePemberkasanKreditReq $request): PemberkasanKredit;
    public function update(UpdatePemberkasanKreditReq $request, string $id): PemberkasanKredit;
    public function destroy(string $id);
    public function addFile(string $id, $file);
}
