<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaPenanggungJawabFieldToInfoPoskoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info_posko', function (Blueprint $table) {
            $table->string('nama_penanggung_jawab', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('info_posko', function (Blueprint $table) {
            $table->dropColumn('nama_penanggun_jawab');
        });
    }
}
