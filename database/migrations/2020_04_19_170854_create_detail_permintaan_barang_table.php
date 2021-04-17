<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPermintaanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_permintaan_barang', function (Blueprint $table) {
            $table->increments('id_detail_permintaan_barang');
            $table->string('id_permintaan_barang', 20);
            $table->string('id_stok_barang', 20);
            $table->integer('jumlah');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_permintaan_barang')->references('id_permintaan_barang')->on('permintaan_barang')->onUpdate('cascade');
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
        Schema::dropIfExists('detail_permintaan_barang');
    }
}
