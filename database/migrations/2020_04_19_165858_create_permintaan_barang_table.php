<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_barang', function (Blueprint $table) {
            $table->string('id_permintaan_barang')->primary();
            $table->string('id_info_posko');
            $table->longText('keterangan_permintaan');
            $table->enum('status_permintaan',['PENDING','VERIFIED','BATAL']);
            $table->boolean('status_pengiriman');
            $table->boolean('status_penerimaan');
            $table->dateTime('tanggal_permintaan');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_info_posko')->references('id_info_posko')->on('info_posko')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaan_barang');
    }
}
