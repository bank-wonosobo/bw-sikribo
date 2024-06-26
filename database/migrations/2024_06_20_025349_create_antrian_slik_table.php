<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianSlikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_slik', function (Blueprint $table) {
            $table->id();
            $table->uuid('permohonan_slik_id');
            $table->foreign('permohonan_slik_id')
                ->references('id')
                ->on('permohonan_slik')
                ->onDelete('cascade');
            $table->integer('nomor_antrian');
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
        Schema::dropIfExists('antrian_slik');
    }
}
