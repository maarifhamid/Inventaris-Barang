<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeluarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("keluar")
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->select('nama_barang','jumlah_keluar','untuk','tanggal_keluar')->get();
    }
}
