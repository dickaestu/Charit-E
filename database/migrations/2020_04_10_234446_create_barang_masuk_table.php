<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->string('id_barang_masuk')->primary();
            $table->string('id_donasi');
            $table->string('id_stok_barang');
            $table->integer('jumlah');
            $table->timestamp('tanggal_barang_masuk');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_donasi')->references('id_donasi')->on('donasi')->onUpdate('cascade');
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
        Schema::dropIfExists('barang_masuk');
    }
}
