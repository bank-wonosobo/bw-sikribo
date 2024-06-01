<?php

namespace App\Services;

use App\Http\Requests\HasilSlik\StoreHasilSlikReq;
use App\Models\HasilSlik;


interface HasilSlikService {
    public function create(StoreHasilSlikReq $req): HasilSlik;
    public function destroy(string $id);
    public function monthlydestroy();
}
