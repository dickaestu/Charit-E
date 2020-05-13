<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_barang', function (Blueprint $table) {
            $table->string('id_pengiriman_barang')->primary();
            $table->string('id_permintaan_barang')->unique();
            $table->longText('keterangan_pengiriman');
            $table->dateTime('tanggal_pengiriman');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_permintaan_barang')->references('id_permintaan_barang')->on('permintaan_barang')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengiriman_barang');
    }
}
