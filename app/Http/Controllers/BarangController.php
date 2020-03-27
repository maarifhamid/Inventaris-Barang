<?php

namespace App\Http\Controllers;

use App\Barang;
use auth;
use DB;
use Alert;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }


    public function index()

    {
        $barang = DB::table('barangs')->sum('jumlah');

        $barang2 = DB::table('barangs')->get();

        $hitung=count($barang2);

        $kategori=DB::table('kategori')->get();

        
        return view('barang.view', compact('barang','hitung','kategori'));
    }

    public function store(Request $request)
    {
        DB::table('barangs')->insert([
            'id_barang' => $request->id_barang,
            'kategori_id'=>$request->kategori_id,
            'nama_barang' =>  $request->nama_barang,
            'satuan' =>  $request->satuan,
            'jumlah' => $request->jumlah,
        ]);
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }

   
    public function edit($id)
    {

        $barang2 = DB::table('barangs')->where('id_barang', $id)->first();
        $barang = DB::table('barangs')->get();
        $kategori = DB::table('kategori')->get();

       

        return view('barang.edit', compact('barang', 'barang2','kategori'));
    }


     public function qrcode($id)
    {

        $qrcode = DB::table('barangs')->where('id_barang', $id)->first();
    
        return view('barang.qrcode', compact('qrcode'));
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
        DB::table('input_ruangan')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('keluar')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('keranjang_keluar')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('keranjang_masuk')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('keranjang_peminjaman')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('keranjang_ruangan')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('masuk')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('peminjaman')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
        ]);
        DB::table('keranjang_rusak_luar')->where('id_barang_rusak_luar', $request->id)->update([
            'id_barang_rusak_luar' => $request->id_barang,
        ]);
        DB::table('keranjang_rusak_ruangan')->where('id_barang_rusak', $request->id)->update([
            'id_barang_rusak' => $request->id_barang,
        ]);
        DB::table('rusak_luar')->where('id_barang_rusak_luar', $request->id)->update([
            'id_barang_rusak_luar' => $request->id_barang,
        ]);
        DB::table('rusak_ruangan')->where('id_barang_rusak', $request->id)->update([
            'id_barang_rusak' => $request->id_barang,
        ]);

        DB::table('barangs')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
            'kategori_id'=>$request->kategori_id,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('barangs')->where('id_barang', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->route('barang.index');
    }
}
