<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class PeminjamanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->select('nama_peminjam','nama_barang','jumlah_pinjam','tanggal_pinjam','tanggal_kembali','status')->get();
    }
}
