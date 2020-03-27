<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class LaporanPeminjaman implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view():View
    {
        return view('laporan.table_peminjaman',[
           'peminjaman'=>$this->data
        ]);
    }
}
