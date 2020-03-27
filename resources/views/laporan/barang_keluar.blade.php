@extends('layouts.layout')
@section('content')
<title>Laporan Data Barang Keluar</title>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Masukan Tanggal Awal dan Akhir</h6>
    </div>
    <div class="card-body">
        <form action="lap_barang_keluar_input" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <input type="date" name="awal" required class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" name="akhir" required class="form-control">
                    </div>
                </div>
            </div>
            <center><input type="submit" class="btn btn-success"></center>
      </form>
<br>
    </div>
</div>
<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Laporan Data Barang Keluar</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    @if ($hitung == 0)
        
    @else
    <form action="/lap_barang_keluar/export_excel">
        <input type="hidden" name="awal" value="{{$req1}}">
        <input type="hidden" name="akhir" value="{{$req2}}">
       <input type="submit" class="btn btn-warning" value="EXPORT EXCEL">
       
       </form>
    @endif
       <br>
    @include('laporan.table_keluar', $keluar )

  </div>
</div>

  
@endsection