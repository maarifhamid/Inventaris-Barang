<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\MasukExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class MasukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $masuk = DB::table("masuk")
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->sum('jumlah_asup');
        
        $masuk2 = DB::table("masuk")
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->get();
        $hitung=count($masuk2);
        
        $barang = DB::table('barangs')->get();

        return view('masuk.view', compact('masuk', 'barang','hitung'));
    }

    public function store(Request $request)
    {

       
        $count = count($request->id_barang);

        for ($i = 0; $i < $count; $i++) {
            DB::table('masuk')->insert([

                'id_barang' =>  $request->id_barang[$i],
                'jumlah_asup' => $request->jumlah[$i],
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);
        }
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

        $masuk2 = DB::table('masuk')->where('id_masuk', $id)->first();
        $masuk = DB::table("masuk")
            ->join('barangs', function ($join) {
                $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('masuk.edit', compact('masuk2', 'masuk', 'barang'));
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

        $cek1 = DB::table('masuk')->where('id_masuk', $request->id_masuk)->first();
        if ($request->jumlah > $cek1->jumlah_asup) {
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk = $request->jumlah - $cek1->jumlah_asup;
            $hitung =  $cek2->jumlah + $hitungmasuk;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
            if ($cek2->jumlah < $hitungmasuk) {
                return redirect()->back();
            }
        } else {
            $cek1 = DB::table('masuk')->where('id_masuk', $request->id_masuk)->first();
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk2 =  $cek1->jumlah_asup - $request->jumlah;
            $hitung =  $cek2->jumlah - $hitungmasuk2;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        }

        DB::table('masuk')->where('id_masuk',$request->id_masuk)->update([
            'id_barang' => $request->id_barang,
            'jumlah_asup' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/masuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('masuk')->where('id_masuk', $id)->delete();
        return redirect()->back();
    }

    // public function detail($id)
    // {

    //     $input_ruangan2 = DB::table('input_ruangan')->where('id_input_ruangan', $id)->first();
    //     $input_ruangan = DB::table("input_ruangan")
    //         ->join('barangs', function ($join) {
    //             $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
    //         })
    //         ->join('ruangan', function ($join) {
    //             $join->on('input_ruangan.id_ruangan', '=', 'ruangan.id_ruangan');
    //         })->get();


    //     return view('input_ruangan.detail', compact('input_ruangan2', 'input_ruangan',));
    // }

    public function export_excel()
    {
        return Excel::download(new MasukExport(), 'masuk.xlsx');
    }

    public function detail($id)
    {
        $masuk=DB::table('masuk')->where('id_masuk',$id)
            ->join('barangs', function ($join) {
                    $join->on('masuk.id_barang', '=', 'barangs.id_barang');
            })->first();
        return view('keranjang_masuk.detail',compact('masuk'));
    }
}
