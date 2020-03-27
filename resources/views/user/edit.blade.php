@extends('layouts.layout')
@section('content')
<title>Edit Data Users</title>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
            <form action="/user/update" method="post">
                    @csrf
                  <div class="form-group">
                      <label for="">Nama</label>
                      <input type="hidden" name="id" class="form-control" value="{{$user2->id}}" required placeholder="Masukan Nama">
                      <input type="text" name="name" class="form-control" value="{{$user2->name}}" required placeholder="Masukan Nama">
                  </div>
                  <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" value="{{$user2->username}}" required placeholder="Masukan Username">
                        {{-- @error('username')
                                <span class="help-block">
                                    <strong style="color:red">{{ $message }}</strong>
                                </span>
                        @enderror --}}
                    </div>
                   <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$user2->email}}" required placeholder="Masukan email">
                        {{-- @error('email')
                            <span class="help-block">
                                <strong style="color:red">{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>
                
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div> 
            </form>
    </div>
@endsection