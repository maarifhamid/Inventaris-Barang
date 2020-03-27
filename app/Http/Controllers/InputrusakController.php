<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use Illuminate\Http\Request;
use Auth;

class InputrusakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index_dalam()

    {
        $kategori=DB::table('kategori')->get();
        $ruangan = DB::table('ruangan')->get();
        $barang = DB::table('barangs')->get();
  
        return view('keranjang_rusak_ruangan.input', compact('ruangan', 'barang','kategori'));

    }

    public function index_luar()

    {
         $kategori=DB::table('kategori')->get();
        $barang = DB::table('barangs')->get();
  
        return view('keranjang_rusak_luar.input', compact('barang','kategori'));

        
    }

      public function getStateList(Request $request)
        {
            $barang = DB::table("barangs")
            ->where("kategori_id",$request->kategori_id)
            ->pluck("nama_barang","id_barang");
            return response()->json($barang);
        }

        public function getStateList2($id)
        {
            $barang = DB::table("barangs")
            ->where("id_barang",$id)
            ->pluck("nama_barang");
            return response()->json($barang);
        }


    public function store_dalam(Request $request)
    {
            $tes = DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->first();
            if($tes == ''){
            Alert::error('Barang Tidak ada di ruangan', 'Gagal');
            return redirect()->back();
        }
            $sin = DB::table('keranjang_rusak_ruangan')->where('id_barang_rusak', $request->id_barang)->where('id_ruangan_rusak',$request->id_ruangan)->count();
            if ($sin == 0) {       
            $tes = DB::table('input_ruangan')->where('id_barang', $request->id_barang)->where('id_ruangan_barang',$request->id_ruangan)->first();
            if ($tes->jumlah_masuk < $request->jumlah) {
                Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                return redirect()->back();
            } else {
                    DB::table('keranjang_rusak_ruangan')->insert([
                        'id_barang_rusak' =>  $request->id_barang,
                        'jumlah_rusak_ruangan' => $request->jumlah,
                        'id_ruangan_rusak' => $request->id_ruangan,
                        'tanggal_rusak' => $request->tanggal_rusak,
                        'status'=>'rusak',
                        'user_id_ruangan'=>Auth::user()->id
                    ]);
                }
            }
        
            
        if ($sin > 0) {
            Alert::error('Salah satu barang Sudah Ada Di Keranjang');
            return redirect()->back();
        }
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }

    public function store_luar(Request $request)
    {

            $sin = DB::table('keranjang_rusak_luar')->where('id_barang_rusak_luar', $request->id_barang)->count();
            if ($sin == 0) {       
            $tes = DB::table('barangs')->where('id_barang', $request->id_barang)->first();
            if ($tes->jumlah < $request->jumlah) {
                Alert::error('Jumlah tidak boleh melewati stok', 'Gagal');
                return redirect()->back();
            } else {
                    DB::table('keranjang_rusak_luar')->insert([
                        'id_barang_rusak_luar' =>  $request->id_barang,
                        'jumlah_rusak_luar' => $request->jumlah,
                        'tanggal_rusak_luar' => $request->tanggal_rusak,
                        'status'=>'rusak',
                        'user_id_luar'=>Auth::user()->id
                    ]);
                }
            }
         
        if ($sin > 0) {
            Alert::error('Salah satu barang Sudah Ada Di Keranjang');
            return redirect()->back();
        }
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }


  
}
