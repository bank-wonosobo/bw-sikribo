<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomiteKreditTable extends Migration
{
    public function up()
    {
        Schema::create('komite_kredit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_register')->unique();
            $table->unsignedBigInteger('kategori_id');
            $table->enum('status', ['Disetujui', 'Ditolak', 'Disetujui Tidak Sesuai Permohonan']);
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_kredit');
        });
    }

    public function down()
    {
        Schema::dropIfExists('komite_kredit');
    }
}
