{{-- set layout dan konten --}}
@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">  
    <div class="x_content">
        {{-- jalankan action --}}
        <form action="/keranjang_ruangan/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- form edit --}}
            <div class="form-group">
                <label for="">Ruangan</label>
                <input type="hidden" name="id_input_ruangan" value="{{$input_ruangan2->id_input_ruangan}}">
                <select name="id_ruangan" id="" class="form-control">
                 @foreach ($ruangan as $r)
                  @if ($input_ruangan2->id_ruangan==$r->id_ruangan)
                  <option value="{{$r->id_ruangan}}" selected="selected">{{$r->ruangan}}</option>
                  @else
                  <option value="{{$r->id_ruangan}}">{{$r->ruangan}}</option>
                      @endif
                @endforeach
            </select>              
        </div>
            <div class="form-group">
                <label for="">Barang</label>
               <select name="id_barang" id="" class="form-control">
                 @foreach ($barang as $r)
                 {{-- jika pilih barang, maka value = barang tersebut --}}
                  @if ($input_ruangan2->id_barang==$r->id_barang)
                  <option value="{{$r->id_barang}}" selected="selected">{{$r->nama_barang}}</option>
                  @else
                  {{-- kalo tidak value tetep barang lama --}}
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
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection