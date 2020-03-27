@extends('layouts.layout')
@section('content')
<title>Laporan Data Barang Ruangan</title>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Masukan Ruangan</h6>
    </div>
    <div class="card-body">
        <form action="lap_barang_ruangan_input" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Ruangan</label>
                        <select name="ruangan" class="form-control" required>
                            <option value="" selected disabled>Pilih Ruangan</option>
                            @foreach ($ruangan as $r)
                                <option value="{{$r->id_ruangan}}">{{$r->ruangan}}</option>
                            @endforeach
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
  <h6 class="m-0 font-weight-bold text-dark">Laporan Data Barang Ruangan</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    
      {{-- <a href="/masuk/export_excel" class="btn btn-warning my-3" target="_blank">EXPORT EXCEL</a> --}}
     
       @if ($hitung == 0)
        
    @else
    
    <form action="/lap_barang_ruangan/export_excel">
        <input type="hidden" name="ruangan" value="{{$req1}}">
       <input type="submit" class="btn btn-warning" value="EXPORT EXCEL">
       
       </form>
    @endif
       <br>
    @include('laporan.table_ruangan', $inputruangan )
  </div>
</div>

  
@endsection