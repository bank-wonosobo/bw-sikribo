<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermohonanSlik extends Model
{
    use HasFactory;

    protected $keyTypr = 'string';
    public $incrementing = false;
    protected $table = 'permohonan_slik';
    protected $guarded = [];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function sliks() {
        return $this->hasMany(Slik::class);
    }

    public function antrian() {
        return $this->hasOne(AntrianPermohonanSlik::class);
    }
}
