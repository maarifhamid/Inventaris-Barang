@extends('layouts.layout') @section('content')
<title>Edit Data Peminjaman</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/peminjaman/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Nama Peminjam</label>
                <input type="hidden" name="id_peminjaman" value="{{$peminjaman2->id_peminjaman}}">
                <input type="text" name="nama_peminjaman" class="form-control" value="{{$peminjaman2->nama_peminjam}}" required placeholder="Masukan Nama">
            </div>
            <div class="form-group">
                <label for="">Nama Barang</label>
                 @foreach ($barang as $r)
                  @if ($peminjaman2->id_barang==$r->id_barang)
                   <input type="hidden" value="{{$r->id_barang}}" class="form-control" name="id_barang">
                   <input type="text" value="{{$r->nama_barang}}" class="form-control" name="" readonly>
                      @endif
                @endforeach 
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="text" name="jumlah" class="form-control" value="{{$peminjaman2->jumlah_pinjam}}" required placeholder="Masukan Ruangan">
            </div>
            <div class="form-group">
                <label for="">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_pinjam" class="form-control" value="{{$peminjaman2->tanggal_pinjam}}" required placeholder="Masukan Ruangan">
            </div>
            <div class="form-group">
                <label for="">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" value="{{$peminjaman2->tanggal_kembali}}" required placeholder="Masukan Ruangan">
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection