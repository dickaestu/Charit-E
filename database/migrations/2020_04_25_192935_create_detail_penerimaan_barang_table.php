<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenerimaanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penerimaan_barang', function (Blueprint $table) {
            $table->string('id_detail_penerimaan_barang')->primary();
            $table->string('id_penerimaan_barang');
            $table->string('id_stok_barang');
            $table->integer('jumlah_penerimaan');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_penerimaan_barang')->references('id_penerimaan_barang')->on('penerimaan_barang')->onUpdate('cascade');
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
        Schema::dropIfExists('detail_penerimaan_barang');
    }
}
