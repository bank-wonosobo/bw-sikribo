<?php

namespace App\Services;

use App\Http\Requests\HasilSlik\StoreHasilSlikReq;
use App\Models\HasilSlik;
use Illuminate\Database\Eloquent\Collection;

interface HasilSlikService {
    public function create(StoreHasilSlikReq $req): HasilSlik;
    public function destroying(string $id);
    public function monthlydestroy();
    public function routinDeletion(int $date_amount = 14): Collection;
}
