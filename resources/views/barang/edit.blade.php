@extends('layouts.layout')
@section('content')
<title>Edit Data Barang</title>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
            <form action="/barang/update" method="post">
                    {{ csrf_field() }}
                  <div class="form-group">
                      <label for="">Kode Barang</label>
                      <input type="hidden" name="id" value="{{$barang2->id_barang}}">
                    <input type="text" name="id_barang" class="form-control" value="{{$barang2->id_barang}}" required placeholder="Masukan Nama">
                  </div>
                  <div class="form-group">
                      <label for="">Kategori</label>
                      <select name="kategori_id" id="" class="form-control" required>
                        @foreach ($kategori as $k)
                          @if ($barang2->kategori_id==$k->id_kategori)
                              <option value="{{$k->id_kategori}}" selected>{{$k->nama_kategori}}</option>
                              @else
                              <option value="{{$k->id_kategori}}">{{$k->nama_kategori}}</option>
                          @endif
                        @endforeach
                      </select>
                    
                  </div>
                  <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{$barang2->nama_barang}}" required placeholder="Masukan barang">
                  </div>
                  <div class="form-group">
                      <label for="">Jenis</label>
                      <input type="text" name="satuan" class="form-control" value="{{$barang2->satuan}}" required>
                  </div>
                  <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" value="{{$barang2->jumlah}}" required placeholder="Masukan Ruangan">
                    </div>
                </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

    </div>
@endsection