<?php

namespace App\Http\Controllers;

use DB;
use auth;
use Alert;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','Admin']);
    }

    public function index()
    {
		$kategori = DB::table('kategori')
		->get();
    	return view('kategori.view',compact('kategori'));
 
    }

    // method untuk insert data ke table jenis
	public function store(Request $request)
	{
		// insert data ke table jenis
		DB::table('kategori')->insert([

			'nama_kategori' => $request->nama_kategori
			
		]);
		// alihkan halaman ke halaman jenis
		Alert::success('Success', 'Data Telah Terinput');
		return redirect('/kategori');
	 
	}

	// method untuk edit data pegawai
	public function edit($id)
	{
		// mengambil data jenis berdasarkan id yang dipilih
		$kategori = DB::table('kategori')->where('id_kategori',$id)->first();
		// passing data jenis yang didapat ke view edit.blade.php
		return view('kategori.edit',['kategori' => $kategori]);
	 
	}

	// update data jenis
	public function update(Request $request)
	{
		// update data jenis
		DB::table('kategori')->where('id_kategori',$request->id_kategori)->update([
			'nama_kategori' => $request->nama_kategori,
		]);
		// alihkan halaman ke halaman jenis
		Alert::success('Success', 'Data Telah Terupdate');
		return redirect('/kategori');
	}

	public function hapus($id)
	{
		// menghapus data jenis berdasarkan id yang dipilih
		DB::table('kategori')->where('id_kategori',$id)->delete();

		// alihkan halaman ke halaman kategori
		Alert::success('Success', 'Data Telah Terhapus');
		return redirect('/kategori');
	}
}
