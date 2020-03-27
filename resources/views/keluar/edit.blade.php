@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/keluar/update" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="{{$keluar2->id_keluar}}" name="id_keluar">
            <div class="form-group">
                <label for="">Barang</label>
                 @foreach ($barang as $r)
                  @if ($keluar2->id_barang==$r->id_barang)
                  <input type="hidden" name="id_barang" id="" class="form-control" value="{{$r->id_barang}}">
               <input type="text" name="" id="" class="form-control" value="{{$r->nama_barang}}" readonly>
                      @endif
                @endforeach
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$keluar2->jumlah_keluar}}" required placeholder="Masukan Jumlah">
            </div>
            <div class="form-group">
                <label for="">Tujuan</label>
                <input type="text" name="untuk" class="form-control" value="{{$keluar2->untuk}}" required placeholder="Masukan Tujuan">
            </div>
            <div class="form-group">
                <label for="">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" value="{{$keluar2->tanggal_keluar}}" required>
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection