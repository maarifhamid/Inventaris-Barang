<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class BarangRuanganExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("input_ruangan")
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->select('ruangan','nama_barang','jumlah_masuk','tanggal_masuk','jumlah_rusak_ruangan')
            ->get();
    }
}
