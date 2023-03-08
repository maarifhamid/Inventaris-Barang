{{-- set layout dan konten --}}
@extends('layouts.layout') @section('content')
<title>Edit Data</title>

{{-- jarak header = 3 --}}
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
{{-- set body dan konten --}}
<div class="card-body">
    <div class="x_content">
        {{-- panggil route input_ruangan/update dengan metode post --}}
        <form action="/input_ruangan/update" method="post" enctype="multipart/form-data">
            {{-- melindungi data masukan user --}}
            {{ csrf_field() }}
            {{-- form edit barang ruangan --}}
            <div class="form-group">
                <label for="">Ruangan</label>
                {{-- ruangan lama disimpan dulu dengan hidden --}}
                <input type="hidden" name="id_input_ruangan" value="{{$input_ruangan2->id_input_ruangan}}">
                {{-- pilih ruangan baru --}}
                <select name="id_ruangan" id="" class="form-control">
                 @foreach ($ruangan as $r)
                 {{-- jika pilih ruangan yang dimaksud --}}
                  @if ($input_ruangan2->id_ruangan_barang==$r->id_ruangan)
                  {{-- value = yang dipilih --}}
                  <option value="{{$r->id_ruangan}}" selected="selected">{{$r->ruangan}}</option>
                  @else
                  {{-- jika tidak value masih yg awal --}}
                  <option value="{{$r->id_ruangan}}">{{$r->ruangan}}</option>
                      @endif
                @endforeach
            </select>              
        </div>
            <div class="form-group">
                <label for="">Barang</label>
                 @foreach ($barang as $r)
                  @if ($input_ruangan2->id_barang==$r->id_barang)
                <input type="hidden" name="id_barang" value="{{$r->id_barang}}" readonly class="form-control">
                <input type="text" value="{{$r->nama_barang}}" readonly class="form-control">
                @endif
                @endforeach

               <select name="id_barang" id="" class="form-control" readonly>
                 @foreach ($barang as $r)
                  @if ($input_ruangan2->id_barang==$r->id_barang)
                  <option value="{{$r->id_barang}}" selected="selected">{{$r->nama_barang}}</option>
                  @else
                  <option value="{{$r->id_barang}}">{{$r->nama_barang}}</option>
                      @endif
                @endforeach
                </select>  

            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$input_ruangan2->jumlah_masuk}}" required placeholder="Masukan Jumlah">
            </div>
            <div class="form-group">
                <label for="">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{$input_ruangan2->tanggal_masuk}}" required placeholder="Masukan Tanggal Masuk">
            </div>
    </div>
    {{-- tombol simpan hijau --}}
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection