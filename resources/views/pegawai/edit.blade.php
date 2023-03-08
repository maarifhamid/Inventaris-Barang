@extends('layouts.layout')
@section('content')
<title>Edit Data Users</title>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
            <form action="/user_pegawai/update" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                      <label for="">Nama</label>
                      <input type="hidden" name="id" class="form-control" value="{{$user2->id}}" required placeholder="Masukan Nama">
                      <input type="text" name="name" class="form-control" value="{{$user2->name}}" required placeholder="Masukan Nama">
                  </div>
                  <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" value="{{$user2->username}}" required placeholder="Masukan Username">
                  </div>
                   <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$user2->email}}" required placeholder="Masukan email">
                  </div>
                  <input type="hidden" name="id_ruangan" class="form-control" value="0" required placeholder="Masukan Nama">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div> 
            </form>
    </div>
@endsection