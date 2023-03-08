<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_ruangan', function (Blueprint $table) {
            $table->bigIncrements('id_input_ruangan');
            $table->foreignId('id_ruangan_barang')->index();
            $table->string('id_barang');
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->integer('jumlah_rusak_ruangan')->default('0');
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
        Schema::dropIfExists('input_ruangan');
    }
}
