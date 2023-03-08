@extends('layouts.layout')
@section('content')
<title>Data Barang Ruangan</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</div>
 <div class="row"> 
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
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
    <div class="card border-left-primary shadow h-100 py-2">
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
       {{--<a href="/barang_ruangan/export_excel" class="btn btn-warning my-3" target="_blank">EXPORT EXCEL</a> --}}
      
      <table id="example" class="table table-bordered js-basic-example dataTable" cellspacing="0">
          <thead>
            <tr>
                  <th>Ruangan</th>
                  <th>Barang</th>
                  <th>Kondisi Baik</th>
                  <th>Tanggal Masuk</th>
                  <th>Kondisi Rusak</th>
                  <th>Total</th>
            </tr>
          </thead>
        </table>
  </div>
</div>

   <script>
 $(document).ready( function () {
    $('#example').DataTable({
           processing: true,
           serverSide: true,
           ajax: "/input_ruangan_json",
           columns: [
                    { data: 'ruangan', name: 'ruangan' },
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'jumlah_masuk', name: 'jumlah_masuk' },
                    { data: 'tanggal_masuk', name: 'tanggal_masuk' },
                    { data: 'jumlah_rusak_ruangan', name: 'jumlah_rusak_ruangan' },
                    { data: 'total', name: 'total' },
                 ]
        });
     });
</script>
@endsection