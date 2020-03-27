<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use Illuminate\Http\Request;

class KeranjangkeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }


    public function index()

    {
        $keluar = DB::table("keranjang_keluar")
            ->join('barangs', function ($join) {
                $join->on('keranjang_keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();
  

        return view('keranjang_keluar.view', compact('keluar', 'barang'));

        
    }

   

    public function store(Request $request)
    {

        for ($a=0; $a < count($request->id_barang); $a++) { 
            $sin = DB::table('keranjang_keluar')->where('id_barang', $request->id_barang[$a])->count();
            if ($sin == 0) {
               
            $tes = DB::table('barangs')->where('id_barang', $request->id_barang[$a])->first();
            if ($tes->jumlah < $request->jumlah[$a]) {
                Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                return redirect()->back();
            } else {

                    DB::table('keranjang_keluar')->insert([

                        'id_barang' =>  $request->id_barang[$a],
                        'jumlah_keluar' => $request->jumlah[$a],
                        'untuk' => $request->untuk,
                        'tanggal_keluar' => $request->tanggal_keluar,
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

        $keluar2 = DB::table('keranjang_keluar')->where('id_keluar', $id)->first();
        $keluar = DB::table("keranjang_keluar")
            ->join('barangs', function ($join) {
                $join->on('keranjang_keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('keranjang_keluar.edit', compact('keluar2', 'keluar', 'barang'));
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
            DB::table('keranjang_keluar')->where('id_keluar', $request->id_keluar)->update([
                'id_barang' => $request->id_barang,
                'jumlah_keluar' => $request->jumlah,
                'untuk' => $request->untuk,
                'tanggal_keluar' => $request->tanggal_keluar
            ]);
        }
        Alert::success('Success', 'Data Telah Terupdate');
        // alihkan halaman ke halaman pegawai
        return redirect('/keranjang_keluar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keranjang_keluar')->where('id_keluar', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

   public function input()
   {

    $select = DB::table('keranjang_keluar')->get();
    
    foreach($select as $s){
       
        DB::table('keluar')->insert([
            'id_barang' => $s->id_barang,
            'jumlah_keluar' => $s->jumlah_keluar,
            'untuk' => $s->untuk,
            'tanggal_keluar' => $s->tanggal_keluar
        ]);
        
        DB::table('keranjang_keluar')->truncate([
            'id_barang' => $s->id_barang,
            'jumlah_keluar' => $s->jumlah_keluar,
            'untuk' => $s->untuk,
            'tanggal_keluar' => $s->tanggal_keluar
        ]);
        
        }
        Alert::success('Success', 'Data Telah Berhasil Di Input');
        return redirect()->back();
   
    }
}
