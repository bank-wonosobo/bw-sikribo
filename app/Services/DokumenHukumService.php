<?php

namespace App\Services;

use App\Http\Requests\StoreDokumenHukumReq;
use App\Http\Requests\UpdateDokumenHukumReq;
use App\Models\DokumenHukum;

interface DokumenHukumService {
    public function create(StoreDokumenHukumReq $request): DokumenHukum;
    public function destroy(string $id);
    public function update(UpdateDokumenHukumReq $request, string $id): DokumenHukum;
    public function addFile(string $id, $file);
}
