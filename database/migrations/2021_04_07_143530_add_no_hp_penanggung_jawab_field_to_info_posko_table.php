<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoHpPenanggungJawabFieldToInfoPoskoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info_posko', function (Blueprint $table) {
            $table->string('no_hp_penanggung_jawab', 14);
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
            $table->dropColumn('no_hp_penanggung_jawab');
        });
    }
}
