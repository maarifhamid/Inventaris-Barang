@extends('layouts.layout')
@section('content')
<title>Laporan Rusak</title>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Masukan Tanggal</h6>
    </div>
    <div class="card-body">
        <form action="lap_rusak_luar_input" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <input type="date" name="awal" required class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" name="akhir" required class="form-control">
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" required>
                            <option value=""selected disabled>Pilih Status</option>
                            <option value="rusak">Rusak</option>
                            <option value="sudah_diperbaiki">Sudah Di Perbaiki</option>
                        </select>
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
  <h6 class="m-0 font-weight-bold text-dark">Laporan Barang Rusak Luar Ruangan</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    
      {{-- <a href="/masuk/export_excel" class="btn btn-warning my-3" target="_blank">EXPORT EXCEL</a> --}}
     @if ($hitung == 0)
        
    @else
    
    <form action="/lap_rusak_luar/export_excel">
        <input type="hidden" name="awal" value="{{$req1}}">
        <input type="hidden" name="akhir" value="{{$req2}}">
        <input type="hidden" name="status" value="{{$req3}}">
       <input type="submit" class="btn btn-warning" value="EXPORT EXCEL">
       
       </form>
    @endif
       <br>
    @include('laporan.table_rusak_luar', $rusak_luar )
      
  </div>
</div>

  
@endsection