<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengirimanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengiriman_barang', function (Blueprint $table) {
            $table->string('id_detail_pengiriman_barang',20)->primary();
            $table->string('id_pengiriman_barang',20);
            $table->string('id_stok_barang',20);
            $table->integer('jumlah');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_pengiriman_barang')->references('id_pengiriman_barang')->on('pengiriman_barang')->onUpdate('cascade');
            $table->foreign('id_stok_barang')->references('id_stok_barang')->on('stok_barang')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengiriman_barang');
    }
}
