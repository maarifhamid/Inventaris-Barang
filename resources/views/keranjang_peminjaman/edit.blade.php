{{-- layout dan konten --}}
@extends('layouts.layout') @section('content')
<title>Edit Data Peminjaman</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        {{-- jalankan action --}}
        <form action="/keranjang_peminjaman/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- form edit --}}
            <div class="form-group">
                <label for="">Nama Peminjam</label>
                {{-- sembunyikan dulu nama peminjam yang lama --}}
                <input type="hidden" name="id_peminjaman" value="{{$peminjaman2->id_peminjaman}}">
                {{-- inputkan yang baru --}}
                <input type="text" name="nama_peminjaman" class="form-control" value="{{$peminjaman2->nama_peminjam}}" required placeholder="Masukan Nama">
            </div>
            <div class="form-group">
                <label for="">Nama Barang</label>
                 <select name="id_barang" id="" class="form-control">
                 @foreach ($barang as $r)
                 {{-- jika pilih nama barang, maka value = nama barang tersebut --}}
                  @if ($peminjaman2->id_barang==$r->id_barang)
                  <option value="{{$r->id_barang}}" selected="selected">{{$r->nama_barang}}</option>
                  @else
                  {{-- jika tidak value masih yg awal --}}
                  <option value="{{$r->id_barang}}">{{$r->nama_barang}}</option>
                      @endif
                @endforeach
                </select> 
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$peminjaman2->jumlah_pinjam}}" required placeholder="Masukan Jumlah">
            </div>
            <div class="form-group">
                <label for="">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_pinjam" class="form-control" value="{{$peminjaman2->tanggal_pinjam}}" required placeholder="Masukan Tanggal Peminjaman">
            </div>
            <div class="form-group">
                <label for="">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" value="{{$peminjaman2->tanggal_kembali}}" required placeholder="Masukan Tanggal Pengembalian">
            </div>
    </div>
    {{-- button --}}
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection