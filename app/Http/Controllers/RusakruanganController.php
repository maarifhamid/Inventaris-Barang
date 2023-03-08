<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\KeluarExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RusakruanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }

    public function index()

    {
        $rusak_ruangan = DB::table("rusak_ruangan")
            ->join('barangs', function ($join) {
                $join->on('rusak_ruangan.id_barang_rusak', '=', 'barangs.id_barang');
            })->join('ruangan', function ($join) {
                $join->on('rusak_ruangan.id_ruangan_rusak', '=', 'ruangan.id_ruangan');
            })->sum('jumlah_rusak_ruangan');

        $rusak_ruangan2 = DB::table("rusak_ruangan")
            ->join('barangs', function ($join) {
                $join->on('rusak_ruangan.id_barang_rusak', '=', 'barangs.id_barang');
            })->get();
        
        $hitung=count($rusak_ruangan2);


        return view('rusak_ruangan.view', compact('rusak_ruangan','hitung'));
    }

    public function edit($id)
    {

        $rusak_ruangan2 = DB::table('rusak_ruangan')->where('id_rusak_ruangan', $id)->first();

        $barang = DB::table('barangs')->get();
        $ruangan=DB::table('ruangan')->get();

        return view('rusak_ruangan.edit', compact('rusak_ruangan2', 'ruangan', 'barang'));
    }

   
    public function update(Request $request)
    {

        $cek1 = DB::table('rusak_ruangan')->where('id_barang_rusak', $request->id_barang)->where('id_ruangan_rusak',$request->id_ruangan)->first();
        if ($request->jumlah > $cek1->jumlah_rusak_ruangan) {

            $cek2 = DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->first();
            $hitungmasuk = $request->jumlah - $cek1->jumlah_rusak_ruangan;
            if ($cek2->jumlah_masuk < $hitungmasuk) {
                Alert::error('Jumlah tidak boleh lebih dari stok di ruangan');
                return redirect()->back();
            }
            $hitung =  $cek2->jumlah_masuk - $hitungmasuk;
            DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->update([
                'jumlah_masuk' => $hitung
            ]);
        } else {
            $cek1 = DB::table('rusak_ruangan')->where('id_barang_rusak', $request->id_barang)->where('id_ruangan_rusak',$request->id_ruangan)->first();
            $cek2 = DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->first();
            $hitungmasuk2 =  $cek1->jumlah_rusak_ruangan - $request->jumlah;
            $hitung =  $cek2->jumlah_masuk + $hitungmasuk2;
            DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->update([
                'jumlah_masuk' => $hitung
            ]);
        }

        DB::table('rusak_ruangan')->where('id_rusak_ruangan',$request->id_rusak_ruangan)->update([
            'id_barang_rusak' => $request->id_barang,
            'jumlah_rusak_ruangan' => $request->jumlah,
            'id_ruangan_rusak' => $request->id_ruangan,
            'tanggal_rusak' => $request->tanggal_rusak,
            'status'=>'rusak'
        ]);

        DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->update([
                'jumlah_rusak_ruangan' => $request->jumlah
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/rusak_ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('rusak_ruangan')->where('id_rusak_ruangan', $id)->delete();
        return redirect()->back();
    }

    public function status($id,$id2)
    {
        $cek = DB::table('rusak_ruangan')->where('id_rusak_ruangan', $id)->first();
        $cek2 = DB::table('input_ruangan')->where('id_barang', $id2)->where('id_ruangan_barang',$cek->id_ruangan_rusak)->first();
        DB::table('rusak_ruangan')->where('id_rusak_ruangan', $id)->update([
            'status' => 'sudah_diperbaiki',
        ]);


        $hitung =  $cek2->jumlah_rusak_ruangan + $cek2->jumlah_masuk;
        DB::table('input_ruangan')->where('id_barang', $id2)->where('id_ruangan_barang',$cek->id_ruangan_rusak)->update([
            'jumlah_masuk' => $hitung,
            'jumlah_rusak_ruangan'=>'0',
        ]);
         Alert::success('Success', 'Status Telah Di Update');
        return redirect('/rusak_ruangan');
    }

    public function export_excel()
    {
        return Excel::download(new KeluarExport(), 'keluar.xlsx');
    }
}
