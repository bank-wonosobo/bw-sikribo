<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    use HasFactory;

    protected $table = 'kredit';
    protected $guarded = [];

    public function kategorikredit() {
        return $this->belongsTo(KategoriKredit::class, 'kategori_id', 'id');
    }
}
