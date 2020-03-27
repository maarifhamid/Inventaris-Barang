<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');


Auth::routes();


Route::post('/user/update','UserController@update');
Route::get('/home', 'HomeController@index');
Route::post('/user/post', 'UserController@update');
Route::get('user/json', 'UserController@json');
Route::resource('user', 'UserController');
Route::resource('barang', 'BarangController');


Route::post('/barang/post', 'BarangController@update');
Route::get('/barang/delete/{id_barang}', 'BarangController@delete');
Route::get('/barang/edit/{id_barang}', 'BarangController@edit');
Route::post('/barang/update', 'BarangController@update');


// ruangan
Route::get('/ruangan', 'RuanganController@index');
Route::post('/ruangan/store', 'RuanganController@store');
Route::get('/ruangan/edit/{id_ruangan}', 'RuanganController@edit');
Route::post('/ruangan/update', 'RuanganController@update');
Route::get('/ruangan/hapus/{id_ruangan}', 'RuanganController@hapus');

// Kategori
Route::get('/kategori', 'KategoriController@index');
Route::post('/kategori/store', 'KategoriController@store');
Route::get('/kategori/edit/{id_Kategori}', 'KategoriController@edit');
Route::post('/kategori/update', 'KategoriController@update');
Route::get('/kategori/hapus/{id_Kategori}', 'KategoriController@hapus');

//users
Route::get('/user/edit/{id}', 'UserController@edit');
Route::get('/pj','UserController@pj');
Route::post('/store_pj','UserController@store_pj');
Route::get('/pj/edit/{id}','UserController@edit_pj');
Route::post('/user_pj/update/','UserController@update_pj');

Route::get('/rayon','UserController@rayon');
Route::post('/store_rayon','UserController@store_rayon');
Route::get('/rayon/edit/{id}','UserController@edit_rayon');
Route::post('/user_rayon/update/','UserController@update_rayon');

Route::get('/bukan_pj','UserController@bukan_pj');
Route::post('/store_bukan_pj','UserController@store_bukan_pj');
Route::get('/bukan_pj/edit/{id}','UserController@edit_bukan_pj');
Route::post('/user_bukan_pj/update/','UserController@update_bukan_pj');

// Peminjaman
Route::get('/peminjaman', 'PeminjamanController@index');
Route::post('/peminjaman/store', 'PeminjamanController@store');
Route::get('/peminjaman/edit/{id_peminjaman}', 'PeminjamanController@edit');
Route::get('/peminjaman/status/{id_peminjaman}/{id_barang}', 'PeminjamanController@status');
Route::get('/peminjaman/detail/{id_peminjaman}', 'PeminjamanController@detail');
Route::post('/peminjaman/update', 'PeminjamanController@update');
Route::get('/peminjaman/delete/{id_peminjaman}', 'PeminjamanController@delete');

//Input Barang Ruangan

Route::get('/input_ruangan', 'InputruanganController@index');
Route::post('/input_ruangan/store', 'InputruanganController@store');
Route::get('/input_ruangan/edit/{id_input_ruangan}', 'InputruanganController@edit');
Route::get('/input_ruangan/detail/{id_input_ruangan}', 'InputruanganController@detail');
Route::post('/input_ruangan/update', 'InputruanganController@update');
Route::get('/input_ruangan/delete/{id_input_ruangan}', 'InputruanganController@delete');

//keluar
Route::get('/keluar', 'KeluarController@index');
Route::post('/keluar/store', 'KeluarController@store');
Route::get('/keluar/edit/{id_keluar}', 'KeluarController@edit');
Route::get('/keluar/detail/{id_keluar}', 'KeluarController@detail');
Route::post('/keluar/update', 'KeluarController@update');
Route::get('/keluar/delete/{id_keluar}', 'KeluarController@delete');

//masuk
Route::get('/masuk', 'MasukController@index');
Route::post('/masuk/store', 'MasukController@store');
Route::get('/masuk/edit/{id_masuk}', 'MasukController@edit');
Route::get('/masuk/detail/{id_masuk}', 'MasukController@detail');
Route::post('/masuk/update', 'MasukController@update');
Route::get('/masuk/delete/{id_masuk}', 'MasukController@delete');
Route::get('/masuk/detail/{id_masuk}', 'MasukController@detail');

//rusak_ruangan
Route::get('/rusak_ruangan', 'RusakruanganController@index');
Route::get('/rusak_ruangan/edit/{id_rusak_ruangan}', 'RusakruanganController@edit');
Route::post('/rusak_ruangan/update', 'RusakruanganController@update');
Route::get('/rusak_ruangan/delete/{id_rusak_ruangan}', 'RusakruanganController@delete');
Route::get('/rusak_ruangan/status/{id_rusak_ruangan}/{id_barang_rusak}', 'RusakruanganController@status');

//rusak_luar
Route::get('/rusak_luar', 'RusakluarController@index');
Route::get('/rusak_luar/edit/{id_rusak_luar}', 'RusakluarController@edit');
Route::post('/rusak_luar/update', 'RusakluarController@update');
Route::get('/rusak_luar/delete/{id_rusak_luar}', 'RusakluarController@delete');
Route::get('/rusak_luar/status/{id_rusak_luar}/{id_barang_rusak}', 'RusakluarController@status');



//keranjang_ruangan
Route::get('/keranjang_ruangan', 'KeranjangruanganController@index');
Route::post('/keranjang_ruangan/store', 'KeranjangruanganController@store');
Route::get('/keranjang_ruangan/edit/{id_input_ruangan}', 'KeranjangruanganController@edit');
Route::post('/keranjang_ruangan/update', 'KeranjangruanganController@update');
Route::get('/keranjang_ruangan/hapus/{id_input_ruangan}', 'KeranjangruanganController@delete');

//keranjang_keluar
Route::get('/keranjang_keluar', 'KeranjangkeluarController@index');
Route::post('/keranjang_keluar/store', 'KeranjangkeluarController@store');
Route::get('/keranjang_keluar/edit/{id_keluar}', 'KeranjangkeluarController@edit');
Route::post('/keranjang_keluar/update', 'KeranjangkeluarController@update');
Route::get('/keranjang_keluar/hapus/{id_keluar}', 'KeranjangkeluarController@delete');

//keranjang_masuk
Route::get('/keranjang_masuk', 'KeranjangmasukController@index');
Route::post('/keranjang_masuk/store', 'KeranjangmasukController@store');
Route::get('/keranjang_masuk/edit/{id_masuk}', 'KeranjangmasukController@edit');
Route::post('/keranjang_masuk/update', 'KeranjangmasukController@update');
Route::get('/keranjang_masuk/hapus/{id_masuk}', 'KeranjangmasukController@delete');
Route::get('/keranjang_masuk/form_input', 'KeranjangmasukController@form_input');
Route::get('/keranjang_masuk/detail_masuk/{id}', 'KeranjangmasukController@detail_masuk');

//keranjang_peminjaman
Route::get('/keranjang_peminjaman', 'KeranjangpeminjamanController@index');
Route::post('/keranjang_peminjaman/store', 'KeranjangpeminjamanController@store');
Route::get('/keranjang_peminjaman/edit/{id_peminjaman}', 'KeranjangpeminjamanController@edit');
Route::post('/keranjang_peminjaman/update', 'KeranjangpeminjamanController@update');
Route::get('/keranjang_peminjaman/hapus/{id_peminjaman}', 'KeranjangpeminjamanController@delete');

//keranjang_rusak ruangan
Route::get('/keranjang_rusak_ruangan', 'KeranjangrusakruanganController@index');
Route::post('/keranjang_rusak_ruangan/store', 'KeranjangrusakruanganController@store');
Route::get('/keranjang_rusak_ruangan/edit/{id_rusak}', 'KeranjangrusakruanganController@edit');
Route::post('/keranjang_rusak_ruangan/update', 'KeranjangrusakruanganController@update');
Route::get('/keranjang_rusak_ruangan/hapus/{id_rusak}', 'KeranjangrusakruanganController@delete');

//keranjang_rusak luar
Route::get('/keranjang_rusak_luar', 'KeranjangrusakluarController@index');
Route::post('/keranjang_rusak_luar/store', 'KeranjangrusakluarController@store');
Route::get('/keranjang_rusak_luar/edit/{id_rusak}', 'KeranjangrusakluarController@edit');
Route::post('/keranjang_rusak_luar/update', 'KeranjangrusakluarController@update');
Route::get('/keranjang_rusak_luar/hapus/{id_rusak}', 'KeranjangrusakluarController@delete');




//Export
Route::get('/peminjaman/export_excel', 'PeminjamanController@export_excel');
Route::get('/barang_ruangan/export_excel', 'InputruanganController@export_excel');
Route::get('/keluar/export_excel', 'KeluarController@export_excel');
Route::get('/masuk/export_excel', 'MasukController@export_excel');
Route::get('/lap_barang_keluar/export_excel', 'LaporanController@export_keluar');
Route::get('/lap_barang_masuk/export_excel', 'LaporanController@export_masuk');
Route::get('/lap_barang_ruangan/export_excel', 'LaporanController@export_ruangan');
Route::get('/lap_peminjaman/export_excel', 'LaporanController@export_peminjaman');
Route::get('/lap_rusak_dalam/export_excel', 'LaporanController@export_rusak_dalam');
Route::get('/lap_rusak_luar/export_excel', 'LaporanController@export_rusak_luar');

//Select Insert
Route::get('/inputpeminjaman','KeranjangpeminjamanController@input');
Route::get('/inputmasuk', 'KeranjangmasukController@input');
Route::get('/inputkeluar', 'KeranjangkeluarController@input');
Route::get('/inputruangan', 'KeranjangruanganController@input');
Route::get('/inputrusakruangan', 'KeranjangrusakruanganController@input');
Route::get('/inputrusakluar', 'KeranjangrusakluarController@input');

//datatable
Route::get('/barang_json','DatatableController@barang_json');
Route::get('/input_ruangan_json','DatatableController@input_ruangan_json');
Route::get('/keluar_json','DatatableController@keluar_json');
Route::get('/masuk_json','DatatableController@masuk_json');
Route::get('/peminjaman_json','DatatableController@peminjaman_json');
Route::get('/rusak_ruangan_json','DatatableController@rusak_ruangan_json');
Route::get('/rusak_luar_json','DatatableController@rusak_luar_json');




Route::get('/barang/qrcode/{id_barang}','BarangController@qrcode');
Route::get('/lap_barang_masuk','LaporanController@lap_barang_masuk');
Route::post('/lap_barang_masuk_input','LaporanController@lap_barang_masuk');
Route::get('/lap_barang_keluar','LaporanController@lap_barang_keluar');
Route::post('/lap_barang_keluar_input','LaporanController@lap_barang_keluar');
Route::get('/lap_barang_ruangan','LaporanController@lap_barang_ruangan');
Route::post('/lap_barang_ruangan_input','LaporanController@lap_barang_ruangan');
Route::get('/lap_peminjaman','LaporanController@lap_peminjaman');
Route::post('/lap_peminjaman_input','LaporanController@lap_peminjaman');
Route::get('/lap_rusak_luar','LaporanController@lap_rusak_luar');
Route::post('/lap_rusak_luar_input','LaporanController@lap_rusak_luar');
Route::get('/lap_rusak_dalam','LaporanController@lap_rusak_dalam');
Route::post('/lap_rusak_dalam_input','LaporanController@lap_rusak_dalam');


Route::get('/pembimbing','PembimbingController@pembimbing');

//inputrusak pj,pem,notpj
Route::get('/input_rusak_dalam','InputrusakController@index_dalam');
Route::post('/input_rusak_dalam/input','InputrusakController@store_dalam');


Route::get('/input_rusak_luar','InputrusakController@index_luar');
Route::post('/input_rusak_luar/input','InputrusakController@store_luar');



Route::get('/get-state-list','InputrusakController@getStateList');

Route::get('/get-state-list2/{id}','InputrusakController@getStateList2');










