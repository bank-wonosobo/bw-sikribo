<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPraKomiteKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pra_komite_kredit', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

    public function down()
    {
        Schema::table('pra_komite_kredit', function (Blueprint $table) {
            $table->enum('status', ['Disetujui', 'Ditolak', 'Disetujui Tidak Sesuai Permohonan'])->after('kategori_id');
        });
    }
}
