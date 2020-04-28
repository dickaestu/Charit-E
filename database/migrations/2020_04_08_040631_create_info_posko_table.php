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
            $table->string('id_info_posko')->primary();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_jenis_bencana');
            $table->string('alamat_posko');
            $table->integer('jumlah_korban');
            $table->integer('jumlah_korban_jiwa');
            $table->string('lokasi_bencana');
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
