<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganDitolakOnTablePermintaanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permintaan_barang', function (Blueprint $table) {
            $table->text('keterangan_ditolak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permintaan_barang', function (Blueprint $table) {
            $table->dropColumn('keterangan_ditolak');
        });
    }
}
