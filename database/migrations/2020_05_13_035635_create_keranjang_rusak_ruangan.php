<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeranjangRusakRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjang_rusak_ruangan', function (Blueprint $table) {
            $table->bigIncrements('id_rusak_ruangan');
            $table->string('id_barang_rusak');
            $table->integer('jumlah_rusak_ruangan');
            $table->foreignId('id_ruangan_rusak')->index();
            $table->date('tanggal_rusak');
            $table->string('status');
            $table->foreignId('user_id_ruangan')->index();
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
        Schema::dropIfExists('keranjang_rusak_ruangan');
    }
}
