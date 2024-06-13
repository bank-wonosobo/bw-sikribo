<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumPermohonanSlikIdHasilSlikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_slik', function (Blueprint $table) {
            $table->uuid('permohonan_slik_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_slik', function (Blueprint $table) {
            $table->dropColumn('permohonan_slik_id');
        });
    }
}
