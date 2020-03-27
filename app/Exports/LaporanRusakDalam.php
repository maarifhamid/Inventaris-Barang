<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class LaporanRusakDalam implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view():View
    {
        return view('laporan.table_rusak_dalam',[
           'rusak_dalam'=>$this->data
        ]);
    }
}
