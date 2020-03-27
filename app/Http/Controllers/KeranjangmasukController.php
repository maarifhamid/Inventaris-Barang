<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use Illuminate\Http\Request;

class KeranjangmasukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $masuk = DB::table("keranjang_masuk")
            ->join('barangs', function ($join) {
                $join->on('keranjang_masuk.id_barang', '=', 'barangs.id_barang');
            })->get();
       
        return view('keranjang_masuk.view', compact('masuk'));
    }

    public function store(Request $request)
    {

       
            $sin = DB::table('keranjang_masuk')->where('id_barang', $request->id_barang)->count();
            if($sin == 0){
                DB::table('keranjang_masuk')->insert([

                    'id_barang' =>  $request->id_barang,
                    'jumlah_asup' => $request->jumlah,
                    'tanggal_masuk' => $request->tanggal_masuk,
                    'harga_satuan'=>$request->harga_satuan,
                    'harga_total'=>$request->harga_total,
                    'nama_toko'=>$request->nama_toko,
                    'merek'=>$request->merek,
                    'sumber_dana'=>$request->sumber_dana
                ]);
            }

        if ($sin > 0) {
            Alert::error('Barang Sudah Ada Di Keranjang');
            return redirect()->back();
        }else{
        Alert::success('Success', 'Data Telah Terinput');
        return redirect('/keranjang_masuk');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */

    public function form_input()
    {
         $barang = DB::table('barangs')->get();
         $kategori=DB::table('kategori')->get();
         return view('keranjang_masuk.input',compact('barang','kategori'));
    }

    public function detail_masuk($id)
    {
        $masuk=DB::table('keranjang_masuk')->where('id_masuk',$id)
            ->join('barangs', function ($join) {
                    $join->on('keranjang_masuk.id_barang', '=', 'barangs.id_barang');
            })->first();
        return view('keranjang_masuk.detail',compact('masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $masuk2 = DB::table('keranjang_masuk')->where('id_masuk', $id)->first();
        $masuk = DB::table("keranjang_masuk")
            ->join('barangs', function ($join) {
                $join->on('keranjang_masuk.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('keranjang_masuk.edit', compact('masuk2', 'masuk', 'barang'));
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

        $tes = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
        if ($tes->jumlah < $request->jumlah) {
            Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
            return redirect()->back();
        } else {
            DB::table('keranjang_masuk')->where('id_masuk', $request->id_masuk)->update([
                    'id_barang' =>  $request->id_barang,
                    'jumlah_asup' => $request->jumlah,
                    'tanggal_masuk' => $request->tanggal_masuk,
                    'harga_satuan'=>$request->harga_satuan,
                    'harga_total'=>$request->harga_total,
                    'nama_toko'=>$request->nama_toko,
                    'merek'=>$request->merek,
                    'sumber_dana'=>$request->sumber_dana
            ]);
        }
        Alert::success('Success', 'Data Telah Terupdate');
        // alihkan halaman ke halaman pegawai
        return redirect('/keranjang_masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keranjang_masuk')->where('id_masuk', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

    public function input()
    {

        $select = DB::table('keranjang_masuk')->get();

        foreach ($select as $s) {
            DB::table('masuk')->insert([
                'id_barang' =>  $s->id_barang,
                'jumlah_asup' => $s->jumlah_asup,
                'tanggal_masuk' => $s->tanggal_masuk,
                'harga_satuan'=>$s->harga_satuan,
                'harga_total'=>$s->harga_total,
                'nama_toko'=>$s->nama_toko,
                'merek'=>$s->merek,
                'sumber_dana'=>$s->sumber_dana
            ]);
        }

        foreach ($select as $s) {
            DB::table('keranjang_masuk')->truncate([
                 'id_barang' =>  $s->id_barang,
                'jumlah_asup' => $s->jumlah_asup,
                'tanggal_masuk' => $s->tanggal_masuk,
                'harga_satuan'=>$s->harga_satuan,
                'harga_total'=>$s->harga_total,
                'nama_toko'=>$s->nama_toko,
                'merek'=>$s->merek,
                'sumber_dana'=>$s->sumber_dana
            ]);
        }

        Alert::success('Success', 'Data Telah Berhasil Di Input');
        return redirect()->back();
    }
}
