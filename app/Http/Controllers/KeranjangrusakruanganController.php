<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
use Illuminate\Http\Request;

class KeranjangrusakruanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $rusak = DB::table("keranjang_rusak_ruangan")
            ->join('barangs', function ($join) {
                $join->on('keranjang_rusak_ruangan.id_barang_rusak', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('keranjang_rusak_ruangan.id_ruangan_rusak', '=', 'ruangan.id_ruangan');
            })
            ->join('users', function ($join) {
                $join->on('keranjang_rusak_ruangan.user_id_ruangan', '=', 'users.id');
            })->get();

        $barang = DB::table('barangs')->get();
        $ruangan=DB::table('ruangan')->get();
  

        return view('keranjang_rusak_ruangan.view', compact('rusak', 'barang','ruangan'));

        
    }

    public function store(Request $request)
    {

        for ($a=0; $a < count($request->id_barang); $a++) { 
            $tes = DB::table('input_ruangan')->where('id_barang', $request->id_barang[$a])->where('id_ruangan_barang',$request->id_ruangan)->first();
            if($tes == ''){
            Alert::error('Barang Tidak ada di ruangan', 'Gagal');
            return redirect()->back();
        }
            $sin = DB::table('keranjang_rusak_ruangan')->where('id_barang_rusak', $request->id_barang[$a])->where('id_ruangan_rusak',$request->id_ruangan)->count();
            if ($sin == 0) {       
            $tes = DB::table('input_ruangan')->where('id_barang', $request->id_barang[$a])->where('id_ruangan_barang',$request->id_ruangan)->first();
            if ($tes->jumlah_masuk < $request->jumlah[$a]) {
                Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                return redirect()->back();
            } else {
                    DB::table('keranjang_rusak_ruangan')->insert([
                        'id_barang_rusak' =>  $request->id_barang[$a],
                        'jumlah_rusak_ruangan' => $request->jumlah[$a],
                        'id_ruangan_rusak' => $request->id_ruangan,
                        'tanggal_rusak' => $request->tanggal_rusak,
                        'status'=>'rusak',
                        'user_id_ruangan'=>Auth::user()->id
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

        $rusak2 = DB::table('keranjang_rusak_ruangan')->where('id_rusak_ruangan', $id)->first();

        $barang = DB::table('barangs')->get();
        $ruangan= DB::table('ruangan')->get();

        return view('keranjang_rusak_ruangan.edit', compact('rusak2','ruangan', 'barang'));
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


        $tes = DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->first();
        if($tes == ''){
            Alert::error('Barang Tidak ada di ruangan', 'Gagal');
            return redirect()->back();
        }
        if ($tes->jumlah_masuk < $request->jumlah) {
            Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
            return redirect()->back();
        } else {
            DB::table('keranjang_rusak_ruangan')->where('id_rusak_ruangan', $request->id_rusak_ruangan)->update([
                'id_barang_rusak' =>  $request->id_barang,
                'jumlah_rusak_ruangan' => $request->jumlah,
                'id_ruangan_rusak' => $request->id_ruangan,
                'tanggal_rusak' => $request->tanggal_rusak,
                'status'=>'rusak'
            ]);
        }
        Alert::success('Success', 'Data Telah Terupdate');
        // alihkan halaman ke halaman pegawai
        return redirect('/keranjang_rusak_ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keranjang_rusak_ruangan')->where('id_rusak_ruangan', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

   public function input()
   {

    $select = DB::table('keranjang_rusak_ruangan')->get();
    
    foreach($select as $s){
          $el1 [] = $s->id_barang_rusak;
          $cek=DB::table('input_ruangan')->where('id_ruangan_barang',$s->id_ruangan_rusak)->whereIn('id_barang',$el1)->where('jumlah_rusak_ruangan',0)->count();
            if($cek==''){
                Alert::error('Salah satu barang rusak sudah ada di data utama');
                return redirect()->back();
            }else{
        DB::table('rusak_ruangan')->insert([
            'id_barang_rusak' =>  $s->id_barang_rusak,
            'jumlah_rusak_ruangan' => $s->jumlah_rusak_ruangan,
            'id_ruangan_rusak' => $s->id_ruangan_rusak,
            'tanggal_rusak' => $s->tanggal_rusak,
            'status'=>$s->status,
            'user_id_ruangan'=>$s->user_id_ruangan
        ]);

        $el [] = $s->id_barang_rusak;
        $r[]=$s->id_ruangan_rusak;

          DB::table('input_ruangan')->where('id_ruangan_barang',$s->id_ruangan_rusak)->whereIn('id_barang',$el)->update([
            'jumlah_rusak_ruangan'=>$s->jumlah_rusak_ruangan,
        ]);

         DB::table('keranjang_rusak_ruangan')->truncate([
            'id_barang_rusak' =>  $s->id_barang_rusak,
            'jumlah_rusak' => $s->jumlah_rusak_ruangan,
            'id_ruangan_rusak' => $s->id_ruangan_rusak,
            'tanggal_rusak' => $s->tanggal_rusak,
            'status'=>$s->status,
            'user_id_ruangan'=>$s->user_id_ruangan
        ]);
        }
    }
    
        Alert::success('Success', 'Data Telah Berhasil Di Input');
        return redirect()->back();
   
    }
}
