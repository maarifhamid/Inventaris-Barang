@extends('layouts.layout')
@section('content')
<title>Data Barang Ruangan</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</div>
 <div class="row"> 
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total jumlah barang di ruangan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$inputruangan}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">total data</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
 <div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Data Barang Ruangan</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    {{-- <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <br>
      <br> --}}
       {{-- <a href="/barang_ruangan/export_excel" class="btn btn-warning my-3" target="_blank">EXPORT EXCEL</a> --}}
      
      <table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>Ruangan</th>
                  <th>Barang</th>
                  <th>Jumlah Baik</th>
                  <th>Tanggal Masuk</th>
                  <th>Jumlah Rusak</th>
                  <th>Total</th>
            </tr>
          </thead>
          <tbody>   
            @foreach ($inputruangan2 as $r)
            <tr>
                <td>{{$r->ruangan}}</td>
                <td>{{$r->nama_barang}}</td>
                <td>{{$r->jumlah_masuk}}</td>
                <td>{{$r->tanggal_masuk}}</td>
                <td>{{$r->jumlah_rusak_ruangan}}</td>
                <td>{{$r->jumlah_masuk + $r->jumlah_rusak_ruangan}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
  </div>
</div>  
@endsection