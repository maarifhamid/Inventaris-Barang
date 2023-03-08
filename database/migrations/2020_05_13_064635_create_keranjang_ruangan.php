<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeranjangRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang_ruangan', function (Blueprint $table) {
            $table->bigIncrements('id_input_ruangan');
            $table->foreignId('id_ruangan')->index();
            $table->string('id_barang');
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
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
        Schema::dropIfExists('keranjang_ruangan');
    }
}
