<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER tg_barang_keluar AFTER INSERT ON `keluar` FOR EACH ROW
                BEGIN
                UPDATE barangs
                SET jumlah = jumlah - NEW.jumlah_keluar
                WHERE
                id_barang = NEW.id_barang;
                END');

        DB::unprepared('CREATE TRIGGER tg_barang_masuk AFTER INSERT ON `input_ruangan` FOR EACH ROW
                BEGIN
                UPDATE barangs
                SET jumlah = jumlah - NEW.jumlah_masuk
                WHERE
                id_barang = NEW.id_barang;
                END');

        DB::unprepared('CREATE TRIGGER tg_masuk_barang AFTER INSERT ON `masuk` FOR EACH ROW
                BEGIN
                UPDATE barangs
                SET jumlah = jumlah + NEW.jumlah_asup
                WHERE
                id_barang = NEW.id_barang;
                END');

        DB::unprepared('CREATE TRIGGER tg_pinjam AFTER INSERT ON `peminjaman` FOR EACH ROW
                BEGIN
                UPDATE barangs
                SET jumlah = jumlah - NEW.jumlah_pinjam
                WHERE
                id_barang = NEW.id_barang;
                END');

        DB::unprepared('CREATE TRIGGER tg_rusak_luar AFTER INSERT ON `rusak_luar` FOR EACH ROW
                BEGIN
                UPDATE barangs
                SET jumlah = jumlah - NEW.jumlah_rusak_luar
                WHERE
                id_barang = NEW.id_barang_rusak_luar;
                END');

        DB::unprepared('CREATE TRIGGER tg_rusak_ruangan AFTER INSERT ON `rusak_ruangan` FOR EACH ROW
                BEGIN
                UPDATE input_ruangan
                SET jumlah_masuk = jumlah_masuk - NEW.jumlah_rusak_ruangan
                WHERE
                id_barang = NEW.id_barang_rusak
                AND
                id_ruangan_barang=NEW.id_ruangan_rusak;
                END');

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
