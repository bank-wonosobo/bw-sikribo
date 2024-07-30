<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPermohonanSlikRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kredit', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_jaminan_id');
            $table->foreign('jenis_jaminan_id')
                ->references('id')->on('jenis_jaminan')->onDelete('cascade');
            $table->string('no_jaminan');
            $table->string('status_pengikatan'); // Selesai, belum selesai
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kredit', function(Blueprint $table) {
            $table->dropColumn('jenis_jaminan_id');
            $table->dropColumn('no_jaminan');
            $table->dropColumn('status_pengikatan');
        });
    }
}
