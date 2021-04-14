<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBarangMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_barang_masuk', function (Blueprint $table) {
            $table->string('id_detail_barang_masuk', 20)->primary();
            $table->string('id_barang_masuk', 20);
            $table->string('id_stok_barang', 20);
            $table->integer('jumlah');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_stok_barang')->references('id_stok_barang')->on('stok_barang')->onUpdate('cascade');
            $table->foreign('id_barang_masuk')->references('id_barang_masuk')->on('barang_masuk')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_barang_masuk');
    }
}
