<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->string('id_donasi')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('id_aktivitas_donasi');
            $table->string('nama_donatur');
            $table->enum('jenis_donasi',['pokok','uang']);
            $table->boolean('status_verifikasi');
            $table->string('keterangan_donasi');
            $table->text('foto_bukti');
            $table->dateTime('tanggal_donasi');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('cascade');
            $table->foreign('id_aktivitas_donasi')->references('id_aktivitas_donasi')->on('aktivitas_donasi')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donasi');
    }
}
