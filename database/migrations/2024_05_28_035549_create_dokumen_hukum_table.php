<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenHukumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor');
            $table->string('status'); // BERLAKU, TIDAK BERLAKU
            $table->string('perihal');
            $table->string('tanggal');
            $table->string('keterangan');
            $table->year('tahun');
            $table->string('file')->nullable(true);
            $table->bigInteger('jenis_dokumen_hukum_id')->unsigned()->index();
            $table->foreign('jenis_dokumen_hukum_id')
                ->references('id')
                ->on('jenis_dokumen_hukum')
                ->onDelete('cascade');
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
        Schema::dropIfExists('dokumen_hukum');
    }
}
