@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/rusak_luar/update" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_rusak_luar" value="{{$rusak_luar2->id_rusak_luar}}">
            <div class="form-group">
                <label for="">Barang</label>
                 @foreach ($barang as $r)
                  @if ($rusak_luar2->id_barang_rusak_luar==$r->id_barang)
                <input type="hidden" name="id_barang" value="{{$r->id_barang}}" readonly class="form-control">
                <input type="text" value="{{$r->nama_barang}}" readonly class="form-control">
                @endif
                @endforeach
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$rusak_luar2->jumlah_rusak_luar}}" required placeholder="Masukan Jumlah">
            </div>
            <div class="form-group">
                <label for="">Tanggal Masuk</label>
                <input type="date" name="tanggal_rusak" class="form-control" value="{{$rusak_luar2->tanggal_rusak_luar}}" required placeholder="Masukan Ruangan">
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection