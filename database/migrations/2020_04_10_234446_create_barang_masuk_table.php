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
            $table->string('id_barang_masuk',20)->primary();
            $table->string('id_donasi',20);
            $table->string('id_stok_barang',20);
            $table->integer('jumlah');
            $table->date('tanggal_barang_masuk');
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
