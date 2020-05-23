<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengeluaranUangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengeluaran_uang', function (Blueprint $table) {
            $table->string('id_detail_pengeluaran_uang',20)->primary();
            $table->string('id_pengeluaran_uang',20);
            $table->string('id_stok_barang',20);
            $table->integer('jumlah');
            $table->integer('nominal');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_pengeluaran_uang')->references('id_pengeluaran_uang')->on('pengeluaran_uang')->onUpdate('cascade');
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
        Schema::dropIfExists('detail_pengeluaran_uang');
    }
}
