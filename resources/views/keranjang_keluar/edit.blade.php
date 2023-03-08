{{-- set layout dan konten --}}
@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        {{-- panggil route --}}
        <form action="/keranjang_keluar/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- form edit keranjang keluar --}}
            <div class="form-group">
                <label for="">Barang</label>
                {{-- id_barang lama simpan dan sembunyikan dulu --}}
                <input type="hidden" name="id_keluar" value="{{$keluar2->id_keluar}}">
                {{-- pilih barang baru --}}
                <select name="id_barang" id="" class="form-control">
                 @foreach ($barang as $r)
                 {{-- jika barang dipilih dari list, maka value = itu --}}
                  @if ($keluar2->id_barang==$r->id_barang)
                  <option value="{{$r->id_barang}}" selected="selected">{{$r->nama_barang}}</option>
                  @else
                  {{-- kalo tidak valuenya masih tetap yang lama --}}
                  <option value="{{$r->id_barang}}">{{$r->nama_barang}}</option>
                      @endif
                @endforeach
                </select> 
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
    {{-- button --}}
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection