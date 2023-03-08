<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use Illuminate\Http\Request;
use Auth;

class KeranjangrusakluarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $rusak = DB::table("keranjang_rusak_luar")
            ->join('barangs', function ($join) {
                $join->on('keranjang_rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
            })->join('users', function ($join) {
                $join->on('keranjang_rusak_luar.user_id_luar', '=', 'users.id');
            })->get();

        $barang = DB::table('barangs')->get();
  

        return view('keranjang_rusak_luar.view', compact('rusak', 'barang'));

        
    }

    public function store(Request $request)
    {

        for ($a=0; $a < count($request->id_barang); $a++) { 
            $sin = DB::table('keranjang_rusak_luar')->where('id_barang_rusak_luar', $request->id_barang[$a])->count();
            if ($sin == 0) {       
            $tes = DB::table('barangs')->where('id_barang', $request->id_barang[$a])->first();
            if ($tes->jumlah < $request->jumlah[$a]) {
                Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                return redirect()->back();
            } else {
                    DB::table('keranjang_rusak_luar')->insert([
                        'id_barang_rusak_luar' =>  $request->id_barang[$a],
                        'jumlah_rusak_luar' => $request->jumlah[$a],
                        'tanggal_rusak_luar' => $request->tanggal_rusak_luar,
                        'status'=>'rusak',
                        'user_id_luar'=>Auth::user()->id
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

        $rusak2 = DB::table('keranjang_rusak_luar')->where('id_rusak_luar', $id)->first();

        $barang = DB::table('barangs')->get();

        return view('keranjang_rusak_luar.edit', compact('rusak2','barang'));
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
            DB::table('keranjang_rusak_luar')->where('id_rusak_luar', $request->id_rusak_luar)->update([
                'id_barang_rusak_luar' =>  $request->id_barang,
                'jumlah_rusak_luar' => $request->jumlah,
                'tanggal_rusak_luar' => $request->tanggal_rusak_luar,
                'status'=>'rusak'   
            ]);
        }
        Alert::success('Success', 'Data Telah Terupdate');
        // alihkan halaman ke halaman pegawai
        return redirect('/keranjang_rusak_luar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keranjang_rusak_luar')->where('id_rusak_luar', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

   public function input()
   {

    $select = DB::table('keranjang_rusak_luar')->get();
    
    foreach($select as $s){
          $el1 [] = $s->id_barang_rusak_luar;
          $cek=DB::table('barangs')->whereIn('id_barang',$el1)->where('jumlah_rusak',0)->count();
            if($cek == ''){
                Alert::error('Barang rusak sudah ada di data utama');
                return redirect()->back();
            }else{
                
        DB::table('rusak_luar')->insert([
            'id_barang_rusak_luar' =>  $s->id_barang_rusak_luar,
            'jumlah_rusak_luar' => $s->jumlah_rusak_luar,
            'tanggal_rusak_luar' => $s->tanggal_rusak_luar,
            'status'=>$s->status,
            'user_id_luar'=>$s->user_id_luar
        ]);

        $el [] = $s->id_barang_rusak_luar;

          DB::table('barangs')->whereIn('id_barang',$el)->update([
            'jumlah_rusak'=>$s->jumlah_rusak_luar,
        ]);

         DB::table('keranjang_rusak_luar')->truncate([
            'id_barang_rusak_luar' =>  $s->id_barang_rusak_luar,
            'jumlah_rusak' => $s->jumlah_rusak_luar,
            'tanggal_rusak_luar' => $s->tanggal_rusak_luar,
            'status'=>$s->status,
            'user_id_luar'=>$s->user_id_luar
        ]);
        }
    }
    
        Alert::success('Success', 'Data Telah Berhasil Di Input');
        return redirect()->back();
   
    }


}
