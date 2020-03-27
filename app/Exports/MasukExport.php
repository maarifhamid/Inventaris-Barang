<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class MasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("masuk")
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->select('nama_barang','jumlah_asup','tanggal_masuk')->get();
       
    }
}
