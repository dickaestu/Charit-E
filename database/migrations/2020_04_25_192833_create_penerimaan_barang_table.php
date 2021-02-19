<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_barang', function (Blueprint $table) {
            $table->string('id_penerimaan_barang', 20)->primary();
            $table->string('id_pengiriman_barang', 20)->unique();
            $table->text('keterangan_penerimaan');
            $table->date('tanggal_penerimaan');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_pengiriman_barang')->references('id_pengiriman_barang')->on('pengiriman_barang')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerimaan_barang');
    }
}
