<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanSlikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_slik', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal')->default(now());
            $table->string('nomor');
            $table->string('peruntukan_ideb');
            $table->string('status'); // prosees pengajuan, selesai
            $table->uuid('pemohon');
            $table->string('petugas_slik')->nullable();
            $table->string('berkas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_slik');
    }
}
