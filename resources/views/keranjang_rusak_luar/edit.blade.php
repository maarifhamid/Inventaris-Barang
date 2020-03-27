@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/keranjang_rusak_luar/update" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_rusak_luar" value="{{$rusak2->id_rusak_luar}}">
            <div class="form-group">
                <label for="">Barang</label>
               <select name="id_barang" id="" class="form-control">
                 @foreach ($barang as $r)
                  @if ($rusak2->id_barang_rusak_luar==$r->id_barang)
                  <option value="{{$r->id_barang}}" selected="selected">{{$r->nama_barang}}</option>
                  @else
                  <option value="{{$r->id_barang}}">{{$r->nama_barang}}</option>
                      @endif
                @endforeach
                </select> 
            </div>

            <div class="form-group">
                <label for="">Jumlah Rusak</label>
                <input type="number" name="jumlah" class="form-control" value="{{$rusak2->jumlah_rusak_luar}}" required placeholder="Masukan Jumlah">
            </div>
            <div class="form-group">
                <label for="">Tanggal Rusak</label>
                <input type="date" name="tanggal_rusak_luar" class="form-control" value="{{$rusak2->tanggal_rusak_luar}}" required placeholder="Masukan Ruangan">
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection