<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranUangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_uang', function (Blueprint $table) {
            $table->string('id_pengeluaran_uang',20)->primary();
            $table->longText('keterangan_pengeluaran');
            $table->date('tanggal_pengeluaran');
            $table->integer('total_pengeluaran');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran_uang');
    }
}
