@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/masuk/update" method="post">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="">Barang</label>
                <input type="hidden" name="id_masuk" value="{{$masuk2->id_masuk}}">
                 @foreach ($barang as $r)
                  @if ($masuk2->id_barang==$r->id_barang)
                  <input value="{{$r->id_barang}}" type="hidden" class="form-control" name="id_barang">
                  <input value="{{$r->nama_barang}}" type="text" class="form-control" name="" readonly>
                      @endif
                @endforeach
               
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$masuk2->jumlah_asup}}" required placeholder="Masukan Jumlah">
            </div>
           
            <div class="form-group">
                <label for="">Tanggal Keluar</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{$masuk2->tanggal_masuk}}" required>
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection