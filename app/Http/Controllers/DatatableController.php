<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Datatables;
use Auth;
class DatatableController extends Controller
{
  
    // fungsi menyimpan data barang
    public function barang_json()
    {
         $barang = DB::table('barangs')
        //  tiap barang memiliki kategori
            ->join('kategori', function ($join) {
                $join->on('barangs.kategori_id', '=', 'kategori.id_kategori');
            })->get();

        // tambah button edit, hapus, dan qrCode di menu barang
        return datatables()->of($barang)
        ->addColumn('action', function ($u) {
            return '<a href="/barang/edit/'.$u->id_barang.'" class="btn btn-primary btn-sm ml-2"">Edit </a><br>
            <a href="/barang/delete/'.$u->id_barang.'" class="btn btn-danger btn-sm ml-2"">Hapus </a><br>
           <a href="/barang/qrcode/'.$u->id_barang.'" class="btn btn-warning btn-sm ml-2"">QR Code </a>
            ';
        })
        // tambah kolom total
        ->addColumn('total', function ($u) {
            return $u->jumlah + $u->jumlah_rusak;
        })

        ->make(true);
 
        return datatables()->of($barang)->make(true);
    }

    // fungsi input ruangan
    public function input_ruangan_json()
    {
        // barang masuk ke ruangan
        $inputruangan = DB::table("input_ruangan")
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->get();

        // tambah button edit dan hapus pada barang ruangan
        return datatables()->of($inputruangan)
        ->addColumn('action', function ($u) {
            return '<a href="/input_ruangan/edit/'.$u->id_input_ruangan.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
            <a href="/input_ruangan/delete/'.$u->id_input_ruangan.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
            ';
        })
        // tambah kolom total
         ->addColumn('total', function ($u) {
            return $u->jumlah_masuk + $u->jumlah_rusak_ruangan;
        })
        ->make(true);

        return datatables()->of($inputruangan)->make(true);
    }

    // fungsi data barang keluar
    public function keluar_json()
    {
      $keluar = DB::table("keluar")
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

            // tambah button edit dan hapus pada barang keluar
              return datatables()->of($keluar)
        ->addColumn('action', function ($u) {
            return '<a href="/keluar/edit/'.$u->id_keluar.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
            <a href="/keluar/delete/'.$u->id_keluar.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
            ';
        })
        ->make(true);

        return datatables()->of($keluar)->make(true);
    }

    // fungsi barang masuk
     public function masuk_json()
    {
        $masuk = DB::table("masuk")
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->get();

            // tambah button edit, hapus, dan detail pada barang masuk
        return datatables()->of($masuk)
        ->addColumn('action', function ($u) {
            return '<a href="/masuk/edit/'.$u->id_masuk.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
            <a href="/masuk/delete/'.$u->id_masuk.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
            <a href="/masuk/detail/'.$u->id_masuk.'" class="btn btn-warning btn-sm ml-2"">Detail </a>
            
            ';
        })
        ->make(true);

        return datatables()->of($masuk)->make(true);
    }

    // fungsi peminjaman
    public function peminjaman_json()
    {
       
     $peminjaman = DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        // tambah button delete, detail, edit dan status
        return datatables()->of($peminjaman)
        ->addColumn('action', function ($u) {
            if ($u->status=='Belum Dikembalikan') {
                return '<a href="/peminjaman/edit/'.$u->id_peminjaman.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                <a href="/peminjaman/delete/'.$u->id_peminjaman.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
                <a href="/peminjaman/detail/'.$u->id_peminjaman.'" class="btn btn-warning btn-sm ml-2"">Detail </a>
                <a href="/peminjaman/status/'.$u->id_peminjaman.'/'.$u->id_barang.'" class="btn btn-success btn-sm ml-2"  onclick="return confirm("Apakah Anda Yakin ?")">Kembalikan </a>
                
            ';
            // kalo status udah di klik, jadi 3 doang
            }else{
                 return '<a href="/peminjaman/edit/'.$u->id_peminjaman.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                 <a href="/peminjaman/delete/'.$u->id_peminjaman.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
                 <a href="/peminjaman/detail/'.$u->id_peminjaman.'" class="btn btn-warning btn-sm ml-2"">Detail </a>
            ';
            }
        })
        ->make(true);

        return datatables()->of($peminjaman)->make(true);
    }

    
    // fungsi rusak ruangan
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

        // tambah button edit delete dan status
        return datatables()->of($rusak_ruangan)
        ->addColumn('action', function ($u) {
            if ($u->status=='rusak') {
                return '<a href="/rusak_ruangan/edit/'.$u->id_rusak_ruangan.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                        <a href="/rusak_ruangan/delete/'.$u->id_rusak_ruangan.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
                        <a href="/rusak_ruangan/status/'.$u->id_rusak_ruangan.'/'.$u->id_barang_rusak.'" class="btn btn-success btn-sm ml-2"  onclick="return confirm("Apakah Anda Yakin ?")">V </a>

            ';
            // kalo status udah di ubah, maka tinggal 2 (edit dan delete)
            }else{
                 return '<a href="/rusak_ruangan/edit/'.$u->id_rusak_ruangan.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                 <a href="/rusak_ruangan/delete/'.$u->id_rusak_ruangan.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>';
            }
        })

        ->addColumn('nama', function ($u) {
           return $u->name;
        })

        // tambah button status, jika klik sudah diperbaiki, maka status berubah jadi sudah diperbaiki
        // kalo belum ya masih rusak
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

    // fungsi barang rusak luar
    public function rusak_luar_json()
    {
       
     $rusak_luar = DB::table("rusak_luar")
            ->join('barangs', function ($join) {
                $join->on('rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
            })->join('users', function ($join) {
                $join->on('rusak_luar.user_id_luar', '=', 'users.id');
            })->get();

        // tambah button edit delete dan status
        return datatables()->of($rusak_luar)
        ->addColumn('action', function ($u) {
            if ($u->status=='rusak') {
                return '<a href="/rusak_luar/edit/'.$u->id_rusak_luar.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                        <a href="/rusak_luar/delete/'.$u->id_rusak_luar.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>
                        <a href="/rusak_luar/status/'.$u->id_rusak_luar.'/'.$u->id_barang_rusak_luar.'" class="btn btn-success btn-sm ml-2"  onclick="return confirm("Apakah Anda Yakin ?")">V </a>

            ';
            // kalo udah diperbaiki, status jadi hilang
            }else{
                 return '<a href="/rusak_luar/edit/'.$u->id_rusak_luar.'" class="btn btn-primary btn-sm ml-2"">Edit </a>
                 <a href="/rusak_luar/delete/'.$u->id_rusak_luar.'" class="btn btn-danger btn-sm ml-2"">Hapus </a>';
            }
        })

        ->addColumn('nama', function ($u) {
           return $u->name;
        })


        // tambah button status
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
