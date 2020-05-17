<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPoskoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_posko', function (Blueprint $table) {
            $table->string('id_sub_posko',20)->primary();
            $table->string('id_info_posko',20);
            $table->string('nama_sub_posko',50);
            $table->string('nama_penanggung_jawab',100);
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
        Schema::dropIfExists('sub_posko');
    }
}
