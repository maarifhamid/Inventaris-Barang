<?php

namespace App\Http\Controllers;

use auth;
use DB;
use Alert;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }



    public function index()

    {
        $peminjaman = DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        $peminjaman2 = DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->sum('jumlah_pinjam');

        $barang = DB::table('barangs')->get();
        $hitung=count($peminjaman);



        return view('peminjaman.view', compact('peminjaman', 'barang','peminjaman2','hitung'));
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
                DB::table('peminjaman')->insert([

                    'id_user' => Auth::user()->id,
                    'no_peminjaman' => $request->no_peminjaman,
                    'nama_peminjam' =>  $request->nama_peminjaman,
                    'id_barang' =>  $request->id_barang[$i],
                    'jumlah_pinjam' => $request->jumlah[$i],
                    'tanggal_pinjam' => $request->tanggal_pinjam,
                    'tanggal_kembali' => $request->tanggal_kembali,
                    'status' => 'Belum Dikembalikan',
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

        $peminjaman2 = DB::table('peminjaman')->where('id_peminjaman', $id)->first();
        $peminjaman = DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('peminjaman.edit', compact('peminjaman2', 'peminjaman', 'barang'));
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

        $cek1 = DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->first();
        if ($request->jumlah > $cek1->jumlah_pinjam) {
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungpinjam = $request->jumlah - $cek1->jumlah_pinjam;
            if ($cek2->jumlah < $hitungpinjam) {
                return redirect()->back();
            }
            $hitung =  $cek2->jumlah - $hitungpinjam;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        } else {
            $cek1 = DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->first();
            $cek2 = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            $hitungpinjam2 =  $cek1->jumlah_pinjam - $request->jumlah;
            $hitung =  $cek2->jumlah + $hitungpinjam2;
            DB::table('barangs')->where('id_barang', $request->id_barang)->update([
                'jumlah' => $hitung
            ]);
        }

        DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->update([
            'nama_peminjam' => $request->nama_peminjaman,
            'jumlah_pinjam' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali
        ]);
        // alihkan halaman ke halaman pegawai
        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::table('peminjaman')->where('id_peminjaman', $id)->delete();
        return redirect()->back();
    }

    public function status($id, $id2)
    {
        $cek = DB::table('peminjaman')->where('id_peminjaman', $id)->first();
        $cek2 = DB::table('barangs')->where('id_barang', $id2)->first();
        DB::table('peminjaman')->where('id_peminjaman', $id)->update([
            'status' => 'Sudah Dikembalikan',
        ]);


        $hitung =  $cek->jumlah_pinjam + $cek2->jumlah;
        DB::table('barangs')->where('id_barang', $id2)->update([
            'jumlah' => $hitung
        ]);
         Alert::success('Success', 'Barang Telah Dikembalikan');
        return redirect('/peminjaman');
    }

    public function detail($id)
    {

        $peminjaman2 = DB::table('peminjaman')->where('id_peminjaman', $id)->first();
        $peminjaman = DB::table("peminjaman")
            ->join('barangs', function ($join) {
                $join->on('peminjaman.id_barang', '=', 'barangs.id_barang');
            })->get();

        $barang = DB::table('barangs')->get();

        return view('peminjaman.detail', compact('peminjaman2', 'peminjaman', 'barang'));
    }

    public function export_excel()
    {
        return Excel::download(new PeminjamanExport(), 'peminjaman.xlsx');
    }
}
