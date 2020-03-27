<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use App\Exports\BarangRuanganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class InputruanganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }


    public function index()

    {
        $inputruangan = DB::table("input_ruangan")
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->sum('jumlah_masuk');

        $inputruangan2 = DB::table("input_ruangan")
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })
            ->get();
        $hitung=count($inputruangan2);
        $ruangan = DB::table('ruangan')->get();
        $barang = DB::table('barangs')->get();

        return view('input_ruangan.view', compact('inputruangan', 'barang', 'ruangan','hitung'));
    }

    public function store(Request $request)
    {

        // $cek = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
        // if ($cek->jumlah < $request->jumlah) {
        //     return redirect()->back();
        // }

        // $hitung =  $cek->jumlah - $request->jumlah;
        // DB::table('barangs')->where('id_barang', $request->id_barang)->update([
        //     'jumlah' => $hitung
        // ]);



        // for ($i = 0; $i < $count; $i++) {
        //     DB::table('tb_bukti_kompetensi')->insert([
        //         'rincian_bukti_kompetensi' => $request->rincian_bukti_kompetensi[$i],
        //         'status_kompetensi' => 'Y',
        //         'pengguna_kompetensi_id' => Auth::user()->id
        //     ]);
        $count = count($request->id_barang);

        for ($i = 0; $i < $count; $i++) {
            $tes = DB::table('barangs')->where('id_barang', $request->id_barang[$i])->first();
            if ($tes->jumlah < $request->jumlah[$i]) {
                return redirect()->back();
            } else {
                DB::table('input_ruangan')->insert([

                    'id_ruangan' => $request->id_ruangan,
                    'id_barang' =>  $request->id_barang[$i],
                    'jumlah_masuk' => $request->jumlah[$i],
                    'tanggal_masuk' => $request->tanggal_masuk,
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

        $input_ruangan2 = DB::table('input_ruangan')->where('id_input_ruangan', $id)->first();
        $input_ruangan = DB::table("input_ruangan")
            ->join('barangs', function ($join) {
                $join->on('input_ruangan.id_barang', '=', 'barangs.id_barang');
            })
            ->join('ruangan', function ($join) {
                $join->on('input_ruangan.id_ruangan_barang', '=', 'ruangan.id_ruangan');
            })->get();

        $ruangan = DB::table('ruangan')->get();
        $barang = DB::table('barangs')->get();

        return view('input_ruangan.edit', compact('input_ruangan2', 'input_ruangan', 'barang', 'ruangan'));
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

        $cek1 = DB::table('input_ruangan')->where('id_input_ruangan', $request->id_input_ruangan)->first();
        if ($request->jumlah > $cek1->jumlah_masuk) {
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk = $request->jumlah - $cek1->jumlah_masuk;
            if ($cek2->jumlah < $hitungmasuk) {
                return redirect()->back();
            }
            $hitung =  $cek2->jumlah - $hitungmasuk;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        } else {
            $cek1 = DB::table('input_ruangan')->where('id_barang', $request->id_barang)->first();
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungmasuk2 =  $cek1->jumlah_masuk - $request->jumlah;
            $hitung =  $cek2->jumlah + $hitungmasuk2;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        }

        DB::table('input_ruangan')->where('id_input_ruangan', $request->id_input_ruangan)->update([
            'id_ruangan_barang' => $request->id_ruangan,
            'jumlah_masuk' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/input_ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('input_ruangan')->where('id_input_ruangan', $id)->delete();
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
        return Excel::download(new BarangRuanganExport(), 'barangruangan.xlsx');
    }
}
