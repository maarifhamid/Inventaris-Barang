<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Alert;
use Illuminate\Http\Request;

class KeranjangruanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $inputruangan = DB::table("keranjang_ruangan")
            ->join('barangs', function ($join) {
                $join->on('keranjang_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('keranjang_ruangan.id_ruangan', '=', 'ruangan.id_ruangan');
            })
            ->get();
        $ruangan = DB::table('ruangan')->get();
        $barang = DB::table('barangs')->get();

        return view('keranjang_ruangan.view', compact('inputruangan', 'barang', 'ruangan'));
    }

    public function store(Request $request)
    {

        for ($a=0; $a < count($request->id_barang); $a++) { 
            $sin = DB::table('keranjang_ruangan')->where('id_barang', $request->id_barang[$a])->count();
            if($sin == 0){
            $tes = DB::table('barangs')->where('id_barang', $request->id_barang[$a])->first();
            if ($tes->jumlah < $request->jumlah[$a]) {
                Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                return redirect()->back();
            } else {
                    DB::table('keranjang_ruangan')->insert([

                        'id_ruangan' => $request->id_ruangan,
                        'id_barang' =>  $request->id_barang[$a],
                        'jumlah_masuk' => $request->jumlah[$a],
                        'tanggal_masuk' => $request->tanggal_masuk,
                    ]);
                }
            }
        }

        if ($sin > 0) {
            Alert::error('Barang Sudah Ada Di Keranjang');
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

        $input_ruangan2 = DB::table('keranjang_ruangan')->where('id_input_ruangan', $id)->first();
        $input_ruangan = DB::table("keranjang_ruangan")
            ->join('barangs', function ($join) {
                $join->on('keranjang_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('keranjang_ruangan.id_ruangan', '=', 'ruangan.id_ruangan');
            })->get();

        $ruangan = DB::table('ruangan')->get();
        $barang = DB::table('barangs')->get();

        return view('keranjang_ruangan.edit', compact('input_ruangan2', 'input_ruangan', 'barang', 'ruangan'));
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
            DB::table('keranjang_ruangan')->where('id_input_ruangan', $request->id_input_ruangan)->update([
                'id_ruangan' => $request->id_ruangan,
                'id_barang' => $request->id_barang,
                'jumlah_masuk' => $request->jumlah,
                'tanggal_masuk' => $request->tanggal_masuk
            ]);
        }
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/keranjang_ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keranjang_ruangan')->where('id_input_ruangan', $id)->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

    public function input()
    {

        $select = DB::table('keranjang_ruangan')->get();

        foreach ($select as $s) {
          $el1 [] = $s->id_barang;
          $cek=DB::table('input_ruangan')->where('id_ruangan_barang',$s->id_ruangan)->whereIn('id_barang',$el1)->count();
            if($cek!=''){
                Alert::error('Salah satu barang rusak sudah ada di data utama');
                return redirect()->back();
            }
            }
            
            foreach ($select as $s) {
            DB::table('input_ruangan')->insert([
                'id_ruangan_barang' => $s->id_ruangan,
                'id_barang' => $s->id_barang,
                'jumlah_masuk' => $s->jumlah_masuk,
                'tanggal_masuk' => $s->tanggal_masuk
            ]);
            }

        foreach ($select as $s) {
            DB::table('keranjang_ruangan')->truncate([
                'id_input_ruangan' => $s->id_input_ruangan,
                'id_ruangan_barang' => $s->id_ruangan,
                'id_barang' => $s->id_barang,
                'jumlah_masuk' => $s->jumlah_masuk,
                'tanggal_masuk' => $s->tanggal_masuk
            ]);
        }

        Alert::success('Success', 'Data Telah Berhasil Di Input');
        return redirect()->back();
    }
}
