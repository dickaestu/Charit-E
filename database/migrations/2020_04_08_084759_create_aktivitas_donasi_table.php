<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivitasDonasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivitas_donasi', function (Blueprint $table) {
            $table->string('id_aktivitas_donasi', 20)->primary();
            $table->string('id_info_posko', 20)->unique();
            $table->text('foto_aktivitas');
            $table->text('keterangan_aktivitas');
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
        Schema::dropIfExists('aktivitas_donasi');
    }
}
