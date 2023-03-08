@extends('layouts.layout')
@section('content')
<title>Edit Data Ruangan</title>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
            <form action="/ruangan/update" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <label for="">Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" value="{{$ruangan->ruangan}}" required placeholder="Masukan ruangan">
                    <input type="hidden" name="id_ruangan" class="form-control" value="{{$ruangan->id_ruangan}}" required placeholder="Masukan Jenis">
                  </div>
                  <div class="form-group">
                <label for="">KASI</label>
                <select name="id_pembimbing"  id="" class="form-control" >
                  <option value="" selected disabled>Pilih KASI</option>
                  @foreach ($pembimbing as $a)
                  <option value="{{$a->id}}" {{$a->id==$ruangan->id_pembimbing? 'selected' : ''}}>{{$a->name}}</option>
                  
                  @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="">Pj</label>
                <select name="id_pj" class="form-control" id="" >
                  <option value="" selected disabled>Pilih Pj</option>
                  @foreach ($pj as $b)
                      <option value="{{$b->id}}" {{$b->id==$ruangan->id_pj ? 'selected' : ''}}>{{$b->name}}</option>
                  @endforeach
                </select>
            </div>
          </div>
                </div> --}}
                
          </div>
                  <button type="submit" class="btn btn-primary">Update</button>
            </form>
    </div>
@endsection