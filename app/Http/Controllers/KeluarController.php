<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\KeluarExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KeluarController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $keluar = DB::table("keluar")
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->sum('jumlah_keluar');

        $keluar2 = DB::table("keluar")
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->get();
        
            $hitung=count($keluar2);
        $barang = DB::table('barangs')->get();

        return view('keluar.view', compact('keluar', 'barang','hitung'));
    }

    public function store(Request $request)
    {


        $count = count($request->id_barang);

        

       
            for ($i = 0; $i < $count; $i++) {
            $tes = DB::table('barangs')->where('id_barang', $request->id_barang[$i])->first();
                if ($tes->jumlah < $request->jumlah[$i]) {
                    return redirect()->back();
                } else {
                DB::table('keluar')->insert([

                    'id_barang' =>  $request->id_barang[$i],
                    'jumlah_keluar' => $request->jumlah[$i],
                    'untuk' => $request->untuk,
                    'tanggal_keluar' => $request->tanggal_keluar,
                ]);
                }
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

        $keluar2 = DB::table('keluar')->where('id_keluar', $id)->first();
        $keluar = DB::table("keluar")
            ->join('barangs', function ($join) {
                $join->on('keluar.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('keluar.edit', compact('keluar2', 'keluar', 'barang'));
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

        $cek1 = DB::table('keluar')->where('id_keluar', $request->id_keluar)->first();
        if ($request->jumlah > $cek1->jumlah_keluar) {
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk = $request->jumlah - $cek1->jumlah_keluar;
            if ($cek2->jumlah < $hitungmasuk) {
                return redirect()->back();
            }
            $hitung =  $cek2->jumlah - $hitungmasuk;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        } else {
            $cek1 = DB::table('keluar')->where('id_keluar', $request->id_keluar)->first();
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk2 =  $cek1->jumlah_keluar - $request->jumlah;
            $hitung =  $cek2->jumlah + $hitungmasuk2;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        }
        
        DB::table('keluar')->where('id_keluar',$request->id_keluar)->update([
            'jumlah_keluar' => $request->jumlah,
            'untuk' => $request->untuk,
            'tanggal_keluar' => $request->tanggal_keluar
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/keluar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('keluar')->where('id_keluar', $id)->delete();
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
        return Excel::download(new KeluarExport(), 'keluar.xlsx');
    }
}
