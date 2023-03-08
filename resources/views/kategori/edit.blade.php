{{-- set layout dan konten --}}
@extends('layouts.layout')
@section('content')
<title>Edit Data Kategori</title>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
      {{-- panggil route --}}
            <form action="/kategori/update" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{-- form edit kategori --}}
                  <div class="form-group">
                    <label for="">Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" value="{{$kategori->nama_kategori}}" required placeholder="Masukan kategori">
                    <input type="hidden" name="id_kategori" class="form-control" value="{{$kategori->id_kategori}}" required placeholder="Id Kategori">
                  </div>
                </div>
                  <button type="submit" class="btn btn-primary">Update</button>
            </form>
    </div>
@endsection