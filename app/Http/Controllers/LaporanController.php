<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\LaporanKeluar;
use App\Exports\LaporanMasuk;
use App\Exports\LaporanRuangan;
use App\Exports\LaporanPeminjaman;
use App\Exports\LaporanRusakLuar;
use App\Exports\LaporanRusakDalam;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }

    public function lap_barang_masuk(Request $request)
    {
        $masuk = DB::table("masuk")->whereBetween('tanggal_masuk',[$request->awal,$request->akhir])
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->get();

            $hitung=count($masuk);
            $req1=$request->awal;
            $req2=$request->akhir;

        return view('laporan.barang_masuk', compact('masuk','req1','req2','hitung'));
    }

    public function lap_barang_keluar(Request $request)
    {
        
        $keluar = DB::table("keluar")->whereBetween('tanggal_keluar',[$request->awal,$request->akhir])
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

        $hitung=count($keluar);
        $req1=$request->awal;
        $req2=$request->akhir;

        return view('laporan.barang_keluar', compact('keluar','hitung','req1','req2'));
    }



    public function lap_barang_ruangan(Request $request)
    {
        
        $inputruangan = DB::table("input_ruangan")->where('id_ruangan_barang',$request->ruangan)
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->get();

        $ruangan=DB::table('ruangan')->get();

        
        $hitung=count($inputruangan);
        $req1=$request->ruangan;

        return view('laporan.barang_ruangan', compact('inputruangan','ruangan','req1','hitung'));
    }

    public function lap_peminjaman(Request $request)
    {
        
        $peminjaman = DB::table("peminjaman")
                        ->whereBetween('tanggal_kembali',[$request->awal,$request->akhir])
                        ->where('status',$request->status)
                            ->join('barangs', function ($join) {
                                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
                            })
                            ->get();

        $hitung=count($peminjaman);
        $req1=$request->awal;
        $req2=$request->akhir;
        $req3=$request->status;


        return view('laporan.barang_pinjam', compact('peminjaman','hitung','req1','req2','req3'));
    }

    public function lap_rusak_dalam(Request $request)
    {
        $rusak_dalam = DB::table("rusak_ruangan")
                        ->whereBetween('tanggal_rusak',[$request->awal,$request->akhir])
                        ->where('status',$request->status)
                            ->join('barangs', function ($join) {
                                $join->on('rusak_ruangan.id_barang_rusak', '=', 'barangs.id_barang');
                            })
                            ->join('ruangan', function ($join) {
                                $join->on('rusak_ruangan.id_ruangan_rusak', '=', 'ruangan.id_ruangan');
                            })
                            ->get();

        $hitung=count($rusak_dalam);
        $req1=$request->awal;
        $req2=$request->akhir;
        $req3=$request->status;

       

        return view('laporan.barang_rusak_ruangan', compact('rusak_dalam','hitung','req1','req2','req3'));
    }

    public function lap_rusak_luar(Request $request)
    {
        
        $rusak_luar = DB::table("rusak_luar")
                        ->whereBetween('tanggal_rusak_luar',[$request->awal,$request->akhir])
                        ->where('status',$request->status)
                            ->join('barangs', function ($join) {
                                $join->on('rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
                            })
                            ->get();

        $hitung=count($rusak_luar);
        $req1=$request->awal;
        $req2=$request->akhir;
        $req3=$request->status;

        return view('laporan.barang_rusak_luar', compact('rusak_luar','hitung','req1','req2','req3'));
    }
    
    public function export_keluar(Request $request)
    {
        $data = DB::table("keluar")->whereBetween('tanggal_keluar',[$request->awal,$request->akhir])
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

        return Excel::download(new LaporanKeluar($data), 'lap_keluar.xlsx');
    }

    public function export_masuk(Request $request)
    {
        $data = DB::table("masuk")->whereBetween('tanggal_masuk',[$request->awal,$request->akhir])
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->get();

        return Excel::download(new LaporanMasuk($data), 'lap_masuk.xlsx');
    }

    public function export_ruangan(Request $request)
    {
        $data = DB::table("input_ruangan")->where('id_ruangan_barang',$request->ruangan)
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->get();
        
        $cek=DB::table("input_ruangan")->where('id_ruangan_barang',$request->ruangan)
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->first();

        return Excel::download(new LaporanRuangan($data), 'lap_r'.$cek->ruangan.'.xlsx');
    }

    public function export_peminjaman(Request $request)
    {
         $data = DB::table("peminjaman")
                ->whereBetween('tanggal_kembali',[$request->awal,$request->akhir])
                ->where('status',$request->status)
                    ->join('barangs', function ($join) {
                        $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
                    })->get();

        return Excel::download(new LaporanPeminjaman($data), 'lap_peminjaman.xlsx');
    }

    public function export_rusak_dalam(Request $request)
    {
         $data = DB::table("rusak_ruangan")
                        ->whereBetween('tanggal_rusak',[$request->awal,$request->akhir])
                        ->where('status',$request->status)
                            ->join('barangs', function ($join) {
                                $join->on('rusak_ruangan.id_barang_rusak', '=', 'barangs.id_barang');
                            })
                            ->join('ruangan', function ($join) {
                                $join->on('rusak_ruangan.id_ruangan_rusak', '=', 'ruangan.id_ruangan');
                            })
                            ->get();
       

        return Excel::download(new LaporanRusakDalam($data), 'lap_rusak_dalam.xlsx');
    }

    public function export_rusak_luar(Request $request)
    {
         $data = DB::table("rusak_luar")
                        ->whereBetween('tanggal_rusak_luar',[$request->awal,$request->akhir])
                        ->where('status',$request->status)
                            ->join('barangs', function ($join) {
                                $join->on('rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
                            })
                            ->get();
                            
        return Excel::download(new LaporanRusakLuar($data), 'lap_rusak_luar.xlsx');
    }
}
