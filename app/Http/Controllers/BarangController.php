<?php

namespace App\Http\Controllers;

use App\Barang;
use auth;
use DB;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }


    public function index()

    {
        // menjumlahkan barang dengan sum
        $barang = DB::table('barangs')->sum('jumlah');

        $barang2 = DB::table('barangs')->get();
        // menghitung jumlah barang 
        $hitung=count($barang2);

        $kategori=DB::table('kategori')->get();

        
        return view('barang.view', compact('barang','hitung','kategori'));
    }
    // fungsi menampilkan data barang
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'kategori_id'=> 'required',
            'nama_barang' =>  'required',
            'satuan' =>  'required',
            'jumlah' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png',
        ]);
            // fungsi untuk upload foto
        if($request->hasFile('foto')){ 
        $file_name = $request->foto->getClientOriginalName();
        $image = $request->foto->move('storage/foto_barang',$file_name);
        

        //UNTUK BLOB
        // $file = $request->file('image');
        // $contents = $file->openFile()->fread($file->getSize());

        // input data barang
        DB::table('barangs')->insert([
            'id_barang' => $request->id_barang,
            'kategori_id'=>$request->kategori_id,
            'nama_barang' =>  $request->nama_barang,
            'satuan' =>  $request->satuan,
            'jumlah' => $request->jumlah,
            'foto' => $image,
        ]);
            // pesan success
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
       }
    }
    
    // fungsi untuk edit
    public function edit($id)
    {

        $barang2 = DB::table('barangs')->where('id_barang', $id)->first();
        $barang = DB::table('barangs')->get();
        $kategori = DB::table('kategori')->get();

       

        return view('barang.edit', compact('barang', 'barang2','kategori'));
    }

// fungsi menampilkan qrcode
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

    //  fungsi untuk update
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

            // validasi
        $request->validate([
            'id_barang' => 'required',
            'kategori_id'=> 'required',
            'nama_barang' =>  'required',
            'satuan' =>  'required',
            'jumlah' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png',
        ]);

        // untuk menampilkan foto
        // storage/foto_barang/20210718_091858.jpg
        if($request->hasFile('foto')){ 
           if($request->oldImage){ 
                Storage::delete($request->oldImage);
           }
            $file_name = $request->foto->getClientOriginalName();
            $image = $request->foto->move('storage/foto_barang',$file_name);
        }
            DB::table('barangs')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
            'kategori_id'=>$request->kategori_id,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'jumlah' => $request->jumlah,
            'foto' => $image,
        ]);
    
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */

        // fungsi hapus data barang
    public function delete($id, Request $request)
    {
       
        DB::table('barangs')->where('id_barang', $id)->delete(); 

        if($request->foto){  
                Storage::delete($request->foto);
           }

        //    pesan sukses hapus
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->route('barang.index');
    }
}