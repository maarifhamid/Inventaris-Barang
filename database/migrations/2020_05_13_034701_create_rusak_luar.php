<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRusakLuar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rusak_luar', function (Blueprint $table) {
            $table->bigIncrements('id_rusak_luar')->index();
            $table->string('id_barang_rusak_luar');
            $table->integer('jumlah_rusak_luar');
            $table->date('tanggal_rusak_luar');
            $table->string('status');
            $table->foreignId('user_id_luar')->index();
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
        Schema::dropIfExists('rusak_luar');
    }
}
