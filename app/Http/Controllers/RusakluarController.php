<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\KeluarExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RusakluarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }


    public function index()
    {
        $rusak_luar = DB::table("rusak_luar")
            ->join('barangs', function ($join) {
                $join->on('rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
            })->sum('jumlah_rusak_luar');

        $rusak_luar2 = DB::table("rusak_luar")
            ->join('barangs', function ($join) {
                $join->on('rusak_luar.id_barang_rusak_luar', '=', 'barangs.id_barang');
            })->get();
        
        $hitung=count($rusak_luar2);


        return view('rusak_luar.view', compact('rusak_luar','hitung'));
    }

    public function edit($id)
    {
        $rusak_luar2 = DB::table('rusak_luar')->where('id_rusak_luar', $id)->first();

        $barang = DB::table('barangs')->get();

        return view('rusak_luar.edit', compact('rusak_luar2', 'barang'));
    }

   
    public function update(Request $request)
    {

        $cek1 = DB::table('rusak_luar')->where('id_barang_rusak_luar', $request->id_barang)->first();
        if ($request->jumlah > $cek1->jumlah_rusak_luar) {

            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk = $request->jumlah - $cek1->jumlah_rusak_luar;
            if ($cek2->jumlah < $hitungmasuk) {
                Alert::error('Jumlah tidak boleh lebih dari stok di ruangan');
                return redirect()->back();
            }
            $hitung =  $cek2->jumlah - $hitungmasuk;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        } else {
            $cek1 = DB::table('rusak_luar')->where('id_barang_rusak_luar', $request->id_barang)->first();
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk2 =  $cek1->jumlah_rusak_luar - $request->jumlah;
            $hitung =  $cek2->jumlah + $hitungmasuk2;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        }

        DB::table('rusak_luar')->where('id_rusak_luar',$request->id_rusak_luar)->update([
            'id_barang_rusak_luar' => $request->id_barang,
            'jumlah_rusak_luar' => $request->jumlah,
            'tanggal_rusak_luar' => $request->tanggal_rusak,
            'status'=>'rusak'
        ]);

        DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah_rusak' => $request->jumlah
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/rusak_luar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('rusak_luar')->where('id_rusak_luar', $id)->delete();
        return redirect()->back();
    }

    public function status($id,$id2)
    {
        $cek = DB::table('rusak_luar')->where('id_rusak_luar', $id)->first();
        $cek2 = DB::table('barangs')->where('id_barang', $id2)->first();
        DB::table('rusak_luar')->where('id_rusak_luar', $id)->update([
            'status' => 'sudah_diperbaiki',
        ]);


        $hitung =  $cek2->jumlah_rusak + $cek2->jumlah;
        DB::table('barangs')->where('id_barang', $id2)->update([
            'jumlah' => $hitung,
            'jumlah_rusak'=>'0',
        ]);
         Alert::success('Success', 'Status Telah Di Update');
        return redirect('/rusak_luar');
    }

    public function export_excel()
    {
        return Excel::download(new KeluarExport(), 'keluar.xlsx');
    }



}
