<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentKreditTable extends Migration
{
    public function up()
    {
        Schema::create('assesment_kredit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_register')->unique();
            $table->string('nomor_kredit');
            $table->unsignedBigInteger('kategori_id');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_kredit');
        });
    }

    public function down()
    {
        Schema::dropIfExists('assesment_kredit');
    }
}
