{{-- template layout --}}
@extends('layouts.layout') 
@section('content')

{{-- judul halaman--}}
<title>Edit Data Barang</title>
{{-- jarak header --}}
<div class="card-header py-3">
  {{-- judul form --}}
  <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
{{-- atur body dan konten --}}
<div class="card-body">
    <div class="x_content">
      {{-- panggil route barang/update dengan metode post --}}
            <form action="/barang/update" method="post" enctype="multipart/form-data">
              {{-- csrf untuk melindungi data pada form --}}
                    {{ csrf_field() }}
                  <div class="form-group">
                      <label for="">Kode Barang</label>
                      {{-- simpan id_barang sebelumnya dengan hidden --}}
                      <input type="hidden" name="id" value="{{$barang2->id_barang}}">
                      {{-- inputkan id_barang baru --}}
                    <input type="text" name="id_barang" class="form-control" value="{{$barang2->id_barang}}" required placeholder="Masukan Nama">
                  </div>

                  <div class="form-group">
                      <label for="">Kategori</label>
                      {{-- pilih kategori --}}
                      <select name="kategori_id" id="" class="form-control" required>
                        {{-- list kategori dan panggil data --}}
                        @foreach ($kategori as $k)
                        {{-- jika pilih kategori yg dimaksud, maka select -> nama kategori --}}
                          @if ($barang2->kategori_id==$k->id_kategori)
                              <option value="{{$k->id_kategori}}" selected>{{$k->nama_kategori}}</option>
                              {{-- jika tidak dipilih maka value tetap nama kategori awal --}}
                              @else
                              <option value="{{$k->id_kategori}}">{{$k->nama_kategori}}</option>
                          @endif
                        @endforeach
                      </select>
                    
                  </div>
                  {{-- form nama barang --}}
                  <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{$barang2->nama_barang}}" required placeholder="Masukan barang">
                  </div>
                  {{-- form jenis --}}
                  <div class="form-group">
                      <label for="">Jenis</label>
                      <input type="text" name="satuan" class="form-control" value="{{$barang2->satuan}}" required>
                  </div>
                  {{-- form jumlah --}}
                  <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="{{$barang2->jumlah}}" required placeholder="Masukan Ruangan">
                    </div>
                    {{-- form upload foto --}}
                    <div class="form-group">
                <label for="">Upload Foto</label>
                {{-- foto lama --}}
                <input type="hidden" name ="oldImage" id="oldImage" value="{{$barang2->foto}}">
                @if($barang2->foto)
                {{-- masukan foto baru --}}
                <input type="file" name="foto" id="foto" class="form-control" value="{{asset($barang2->foto) }}" accept="image/*" required>
                @else 
                <p>Tidak ada foto</p>
                </div>
                @endif
                <div class="form-group"><br>
                  {{-- jika tidak ada foto, maka tampilkan foto size 100x100 --}}
                  {{-- strlen --> menghitung panjang string --}}
                @if(strlen($barang2->foto)>0)
                <img src="{{ asset($barang2->foto) }}" weidth ="100" height="100">
                @endif
            </div>
                </div>
                {{-- tombol button simpan warna hijau --}}
                  <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

    </div>
@endsection