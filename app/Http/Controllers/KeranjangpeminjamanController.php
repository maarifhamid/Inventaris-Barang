<?php

namespace App\Http\Controllers;

use auth;
use DB;
use Alert;
use Illuminate\Http\Request;

class KeranjangpeminjamanController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $peminjaman = DB::table("keranjang_peminjaman")
            ->join('barangs', function ($join) {
                $join->on('keranjang_peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('keranjang_peminjaman.view', compact('peminjaman', 'barang'));
    }

    public function store(Request $request)
    {

        
        for ($a=0; $a < count($request->id_barang); $a++) { 
            $sin = DB::table('keranjang_peminjaman')->where('id_barang', $request->id_barang[$a])->count();

            if ($sin == 0) {
    
                    $tes = DB::table('barangs')->where('id_barang', $request->id_barang[$a])->first();
                    if ($tes->jumlah < $request->jumlah[$a]) {
                        Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                        return redirect()->back();
                    } else {
                        DB::table('keranjang_peminjaman')->insert([
                            'nama_peminjam' =>  $request->nama_peminjaman,
                            'id_barang' =>  $request->id_barang[$a],
                            'jumlah_pinjam' => $request->jumlah[$a],
                            'tanggal_pinjam' => $request->tanggal_pinjam,
                            'tanggal_kembali' => $request->tanggal_kembali,
                            'status' => 'Belum Dikembalikan',
                        ]);
                    }
            }
        }
        
        if ($sin > 0) {
            Alert::error('Salah satu barang Sudah Ada Di Keranjang');
            return redirect()->back();
        }
        
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */

    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $peminjaman2 = DB::table('keranjang_peminjaman')->where('id_peminjaman', $id)->first();
        $peminjaman = DB::table("keranjang_peminjaman")
            ->join('barangs', function ($join) {
                $join->on('keranjang_peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('keranjang_peminjaman.edit', compact('peminjaman2', 'peminjaman', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // $cek1 = DB::table('peminjaman')->where('id_barang', $request->id_barang)->first();
        // if ($request->jumlah > $cek1->jumlah_pinjam) {
        //     $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
        //     $hitungpinjam = $request->jumlah - $cek1->jumlah_pinjam;
        //     if ($cek2->jumlah < $hitungpinjam) {
        //         return redirect()->back();
        //     }
        //     $hitung =  $cek2->jumlah - $hitungpinjam;
        //     DB::table('barangs')->where('id_barang', $request->id_barang)->update([
        //         'jumlah' => $hitung
        //     ]);
        // } else {

        //     $cek1 = DB::table('peminjaman')->where('id_barang', $request->id_barang)->first();
        //     $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
        //     $hitungpinjam2 =  $cek1->jumlah_pinjam - $request->jumlah;
        //     $hitung =  $cek2->jumlah + $hitungpinjam2;
        //     DB::table('barangs')->where('id_barang', $request->id_barang)->update([
        //         'jumlah' => $hitung
        //     ]);
        // }
        $tes = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
        if ($tes->jumlah < $request->jumlah) {
            Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
            return redirect()->back();
        } else {
            DB::table('keranjang_peminjaman')->where('id_peminjaman', $request->id_peminjaman)->update([
                'nama_peminjam' => $request->nama_peminjaman,
                'id_barang' => $request->id_barang,
                'jumlah_pinjam' => $request->jumlah,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali
            ]);
        }
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/keranjang_peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keranjang_peminjaman')->where('id_peminjaman', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

    public function input()
    {

        $select = DB::table('keranjang_peminjaman')->get();

        foreach ($select as $s) {
            DB::table('peminjaman')->insert([
                'nama_peminjam' => $s->nama_peminjam,
                'id_barang' => $s->id_barang,
                'jumlah_pinjam' => $s->jumlah_pinjam,
                'tanggal_pinjam' => $s->tanggal_pinjam,
                'tanggal_kembali' => $s->tanggal_kembali,
                'status'=>$s->status
            ]);
        }

        foreach ($select as $s) {
            DB::table('keranjang_peminjaman')->truncate([
                'id_peminjaman' => $s->id_peminjaman,
                'nama_peminjam' => $s->nama_peminjam,
                'id_barang' => $s->id_barang,
                'jumlah_pinjam' => $s->jumlah_pinjam,
                'tanggal_pinjam' => $s->tanggal_pinjam,
                'tanggal_kembali' => $s->tanggal_kembali,
                'status' => $s->status
            ]);
        }

        Alert::success('Success', 'Data Telah Berhasil Di Input');
        return redirect()->back();
    }
}
