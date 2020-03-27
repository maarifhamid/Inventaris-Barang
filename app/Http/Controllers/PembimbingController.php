<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\BarangRuanganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;

class PembimbingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function pembimbing()
    {
    if (Auth::user()->level=='rayon' || Auth::user()->level=='pj') {
        $cek=DB::table('ruangan')->where('id_pembimbing',Auth::user()->id)->orWhere('id_pj',Auth::user()->id)->get();
            foreach($cek as $c)
                    {
                        $kotak [] = $c->id_ruangan;
                    }
       $inputruangan = DB::table("input_ruangan")->whereIn('id_ruangan_barang',$kotak)
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->sum('jumlah_masuk');

        $inputruangan2 = DB::table("input_ruangan")->whereIn('id_ruangan_barang',$kotak)
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->get();

        $inputruangan3 = DB::table("input_ruangan")->whereIn('id_ruangan_barang',$kotak)
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->first();

        $hitung=count($inputruangan2);

        $cek=count($inputruangan2);
        if ($cek=='0') {
            $cek=DB::table('ruangan')->where('id_ruangan',Auth::user()->id_ruangan)->first();
            Alert::error('Data barang di ruangan tidak ada','Error');
            return redirect()->back();
        }else{
       
        return view('pembimbing.view', compact('inputruangan','hitung','inputruangan2','inputruangan3'));
        }
    }
    else{
         return redirect()->back();
    } 
    }

}
