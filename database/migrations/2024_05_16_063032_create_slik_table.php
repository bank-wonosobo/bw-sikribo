<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slik', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('nik');
            $table->enum('status', ['ADA', 'TIDAK ADA', 'PROSES']);
            $table->string('identitas_slik'); // DEBITUR, PASANGAN DEBITUR, PENJAMIN, PASANGAN PENJAMIN
            $table->string('no_ref_slik');
            $table->uuid('permohonan_slik_id');
            $table->foreign('permohonan_slik_id')
                ->references('id')->on('permohonan_slik')
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
        Schema::dropIfExists('slik');
    }
}
