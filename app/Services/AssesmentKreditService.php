<?php

namespace App\Services;

use App\Http\Requests\AssesmentKredit\StoreAssesmentKreditReq;
use App\Http\Requests\AssesmentKredit\UpdateAssesmentKreditReq;
use App\Models\AssesmentKredit;

interface AssesmentKreditService
{
    public function create(StoreAssesmentKreditReq $request): AssesmentKredit;
    public function update(UpdateAssesmentKreditReq $request, string $id): AssesmentKredit;
    public function destroy(string $id);
    public function addFile(string $id, $file);
}
