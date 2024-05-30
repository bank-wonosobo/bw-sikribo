<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DokumenHukum extends Model
{
    use HasFactory;

    protected $keyTypr = 'string';
    public $incrementing = false;
    protected $table = 'dokumen_hukum';
    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function jenisDokumen() {
        return $this->belongsTo(JenisDokumenHukum::class, 'jenis_dokumen_hukum_id', 'id');
    }
}
