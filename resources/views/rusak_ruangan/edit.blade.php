{{-- set layout dan konten --}}
@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        {{-- panggil route rusak ruangan/update --}}
        <form action="/rusak_ruangan/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- form edit rusak ruangan --}}
            <div class="form-group">
                <label for="">Ruangan</label>
                {{-- id_rusak_ruangan sebelumnya disembunyikan --}}
                <input type="hidden" name="id_rusak_ruangan" value="{{$rusak_ruangan2->id_rusak_ruangan}}">
                 @foreach ($ruangan as $r)
                 {{-- jika rusak ruangan dipilih, maka yg lama sembunyikan ganti dengan inputan id ruangan baru --}}
                  @if ($rusak_ruangan2->id_ruangan_rusak==$r->id_ruangan)
                  <input type="hidden" name="id_ruangan" value="{{$r->id_ruangan}}">
                  <input type="number" readonly value="{{$r->ruangan}}" class="form-control">
                  @endif
                @endforeach
            </select>              
        </div>
            <div class="form-group">
                <label for="">Barang</label>
                 @foreach ($barang as $r)
                 {{-- jika id_barang dipilih, maka yg lama sembunyikan ganti dengan inputan id_barang baru --}}
                  @if ($rusak_ruangan2->id_barang_rusak==$r->id_barang)
                <input type="hidden" name="id_barang" value="{{$r->id_barang}}" readonly class="form-control">
                <input type="text" value="{{$r->nama_barang}}" readonly class="form-control">
                @endif
                @endforeach
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$rusak_ruangan2->jumlah_rusak_ruangan}}" required placeholder="Masukan Jumlah">
            </div>
            <div class="form-group">
                <label for="">Tanggal Masuk</label>
                <input type="date" name="tanggal_rusak" class="form-control" value="{{$rusak_ruangan2->tanggal_rusak}}" required placeholder="Masukan Ruangan">
            </div>
    </div>
    {{-- button simpan --}}
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection