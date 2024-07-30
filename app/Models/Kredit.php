<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kredit extends Model
{
    use HasFactory;
    protected $keyTypr = 'string';
    public $incrementing = false;
    protected $table = 'kredit';
    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function kategorikredit() {
        return $this->belongsTo(KategoriKredit::class, 'kategori_id', 'id');
    }

    public function jenisJaminan() {
        return $this->belongsTo(JenisJaminan::class, 'jenis_jaminan_id', 'id');
    }
}
