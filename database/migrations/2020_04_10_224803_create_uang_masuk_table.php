<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUangMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uang_masuk', function (Blueprint $table) {
            $table->string('id_uang_masuk')->primary();
            $table->string('id_donasi');
            $table->integer('nominal');
            $table->dateTime('tanggal_masuk');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_donasi')->references('id_donasi')->on('donasi')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uang_masuk');
    }
}
