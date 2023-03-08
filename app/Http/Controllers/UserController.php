<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use DataTables;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }

    public function index2()
    {
        return view('auth.login');
    }

    public function index()
    {
        $user = DB::table("users")->where('level','admin')->get();
        return view('user.view', compact('user'));
    }

    public function pj()
    {
        $user = DB::table("users")->where('level','pj')->get();
        $ruangan=DB::table('ruangan')->get();
        return view('pj.view', compact('user','ruangan'));
    }

    public function kasi()
    {

        $user = DB::table("users")->where('level','kasi')->get();

        $ruangan=DB::table('ruangan')->get();

        return view('kasi.view', compact('user','ruangan'));
    }

     public function pegawai()
    {

        $user = DB::table("users")->where('level','pegawai')->get();

        return view('pegawai.view', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'email'=>'required|unique:users',
            'username' => 'required|unique:users',
        ]);

        $password = Hash::make($request->password);
        $data = array_replace($request->all(), ['password' => $password]);

        User::create($data);
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user2 = DB::table('users')->where('id', $id)->first();
        $user = DB::table('users')->get();

        $ruangan = DB::table('ruangan')->get();

        return view('user.edit', compact('user', 'ruangan', 'user2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        DB::table('users')->where('id',$request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username
        ]);

        Alert::success('Success', 'Data Telah Terupdate');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Success', 'Data Telah Terhapus');
        return redirect()->back();
    }

    //pj

    public function store_pj(Request $request)
    {
      
        $request->validate([
            'email'=>'required|unique:users',
            'username' => 'required|unique:users',
        ]);

        $password = Hash::make($request->password);
        $data = array_replace($request->all(), ['password' => $password]);

        User::create($data);
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }

    public function edit_pj($id)
    {
        $user2 = DB::table('users')->where('id', $id)->first();
        

        $ruangan = DB::table('ruangan')->get();

        return view('pj.edit', compact('ruangan', 'user2'));
    }

    public function update_pj(Request $request)
    {
        
        DB::table('users')->where('id',$request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
            
        ]);

        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/pj');
    }

    //kasi

    public function store_kasi(Request $request)
    {
      
        $request->validate([
            'email'=>'required|unique:users',
            'username' => 'required|unique:users',
        ]);

        $password = Hash::make($request->password);
        $data = array_replace($request->all(), ['password' => $password]);

        User::create($data);
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }

    public function edit_kasi($id)
    {
        $user2 = DB::table('users')->where('id', $id)->first();
        

        $ruangan = DB::table('ruangan')->get();

        return view('kasi.edit', compact('ruangan', 'user2'));
    }

    public function update_kasi(Request $request)
    {
        
        DB::table('users')->where('id',$request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
            
        ]);

        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/kasi');
    }

    //bukan pj

    public function store_pegawai(Request $request)
    {
      
        $request->validate([
            'email'=>'required|unique:users',
            'username' => 'required|unique:users',
        ]);

        $password = Hash::make($request->password);
        $data = array_replace($request->all(), ['password' => $password]);

        User::create($data);
        Alert::success('Success', 'Data Telah Terinput');
        return redirect()->back();
    }

    public function edit_pegawai($id)
    {
        $user2 = DB::table('users')->where('id', $id)->first();
        

        $ruangan = DB::table('ruangan')->get();

        return view('pegawai.edit', compact('ruangan', 'user2'));
    }

    public function update_pegawai(Request $request)
    {
        
        DB::table('users')->where('id',$request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
           
        ]);

        Alert::success('Success', 'Data Telah Terupdate');
        return redirect('/pegawai');
    }


}
