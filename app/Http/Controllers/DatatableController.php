<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Datatables;
use Auth;
class DatatableController extends Controller
{
  
  
    public function barang_json()
    {
         $barang = DB::table('barangs')
            ->join('kategori', function ($join) {
                $join->on('barangs.kategori_id', '=', 'kategori.id_kategori');
            })->get();


        return datatables()->of($barang)
        ->addColumn('action', function ($u) {
            return '<a href="/barang/edit/'.$u->id_barang.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
           <a href="/barang/qrcode/'.$u->id_barang.'" class="btn btn-warning btn-sm ml-2"">QR Code </a>
            ';
        })
        ->addColumn('total', function ($u) {
            return $u->jumlah + $u->jumlah_rusak;
        })
        ->make(true);
        
        return datatables()->of($barang)->make(true);
    }

    public function input_ruangan_json()
    {
        $inputruangan = DB::table("input_ruangan")
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->get();

            
        return datatables()->of($inputruangan)
        ->addColumn('action', function ($u) {
            return '<a href="/input_ruangan/edit/'.$u->id_input_ruangan.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
            ';
        })
         ->addColumn('total', function ($u) {
            return $u->jumlah_masuk + $u->jumlah_rusak_ruangan;
        })
        ->make(true);

        return datatables()->of($inputruangan)->make(true);
    }
    public function keluar_json()
    {
      $keluar = DB::table("keluar")
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

              return datatables()->of($keluar)
        ->addColumn('action', function ($u) {
            return '<a href="/keluar/edit/'.$u->id_keluar.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
            ';
        })
        ->make(true);

        return datatables()->of($keluar)->make(true);
    }
     public function masuk_json()
    {
        $masuk = DB::table("masuk")
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->get();

        return datatables()->of($masuk)
        ->addColumn('action', function ($u) {
            return '<a href="/masuk/edit/'.$u->id_masuk.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
            <a href="/masuk/detail/'.$u->id_masuk.'" class="btn btn-warning btn-sm ml-2"">Detail </a>
            
            ';
        })
        ->make(true);

        return datatables()->of($masuk)->make(true);
    }


    public function peminjaman_json()
    {
       
     $peminjaman = DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        return datatables()->of($peminjaman)
        ->addColumn('action', function ($u) {
            if ($u->status=='Belum Dikembalikan') {
                return '<a href="/peminjaman/edit/'.$u->id_peminjaman.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                <a href="/peminjaman/detail/'.$u->id_peminjaman.'" class="btn btn-warning btn-sm ml-2"">Detail </a>
                <a href="/peminjaman/status/'.$u->id_peminjaman.'/'.$u->id_barang.'" class="btn btn-success btn-sm ml-2"  onclick="return confirm("Apakah Anda Yakin ?")">Kembalikan </a>
                
            ';
            }else{
                 return '<a href="/peminjaman/detail/'.$u->id_peminjaman.'" class="btn btn-warning btn-sm ml-2"">Detail </a>
            ';
            }
        })
        ->make(true);

        return datatables()->of($peminjaman)->make(true);
    }

    

    public function rusak_ruangan_json()
    {
       
     $rusak_ruangan = DB::table("rusak_ruangan")
            ->join('barangs', function ($join) {
                $join->on('rusak_ruangan.id_barang_rusak', '=', 'barangs.id_barang');
            })->join('ruangan', function ($join) {
                $join->on('rusak_ruangan.id_ruangan_rusak', '=', 'ruangan.id_ruangan');
            })
            ->join('users', function ($join) {
                $join->on('rusak_ruangan.user_id_ruangan', '=', 'users.id');
            })->get();

        return datatables()->of($rusak_ruangan)
        ->addColumn('action', function ($u) {
            if ($u->status=='rusak') {
                return '<a href="/rusak_ruangan/edit/'.$u->id_rusak_ruangan.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                        <a href="/rusak_ruangan/status/'.$u->id_rusak_ruangan.'/'.$u->id_barang_rusak.'" class="btn btn-success btn-sm ml-2"  onclick="return confirm("Apakah Anda Yakin ?")">V </a>

            ';
            }else{
                 return 'Tidak ada opsi';
            }
        })

        ->addColumn('nama', function ($u) {
           return $u->name;
        })

          ->addColumn('status_rusak', function ($u) {
            if ($u->status=='sudah_diperbaiki') {
                return 'Sudah Di Perbaiki';
            }else{
                 return 'Rusak';
            }
        })
        ->make(true);
        return datatables()->of($rusak_ruangan)->make(true);
    }

    public function rusak_luar_json()
    {
       
     $rusak_luar = DB::table("rusak_luar")
            ->join('barangs', function ($join) {
                $join->on('rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
            })->join('users', function ($join) {
                $join->on('rusak_luar.user_id_luar', '=', 'users.id');
            })->get();

        return datatables()->of($rusak_luar)
        ->addColumn('action', function ($u) {
            if ($u->status=='rusak') {
                return '<a href="/rusak_luar/edit/'.$u->id_rusak_luar.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                        <a href="/rusak_luar/status/'.$u->id_rusak_luar.'/'.$u->id_barang_rusak_luar.'" class="btn btn-success btn-sm ml-2"  onclick="return confirm("Apakah Anda Yakin ?")">V </a>

            ';
            }else{
                 return 'Tidak ada opsi';
            }
        })

        ->addColumn('nama', function ($u) {
           return $u->name;
        })



          ->addColumn('status_rusak', function ($u) {
            if ($u->status=='sudah_diperbaiki') {
                return 'Sudah Di Perbaiki';
            }else{
                 return 'Rusak';
            }
        })
        ->make(true);
        return datatables()->of($rusak_luar)->make(true);
    }

    
}
