<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class LaporanMasuk implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view():View
    {
        return view('laporan.table_masuk',[
           'masuk'=>$this->data
        ]);
    }
}
