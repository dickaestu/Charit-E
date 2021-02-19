<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPoskoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_posko', function (Blueprint $table) {
            $table->string('id_info_posko', 20)->primary();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('id_jenis_bencana')->unsigned();
            $table->string('alamat_posko', 180);
            $table->integer('jumlah_korban');
            $table->integer('jumlah_korban_jiwa');
            $table->string('lokasi_bencana', 150);
            $table->date('tanggal_kejadian');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('cascade');
            $table->foreign('id_jenis_bencana')->references('id_jenis_bencana')->on('jenis_bencana')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_posko');
    }
}
