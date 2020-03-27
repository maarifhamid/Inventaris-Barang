@extends('layouts.layout')
@section('content')
<title>Data Kategori</title>

<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Data Kategori</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <br>
      <br>
      <table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>No</th>
                  <th>Kategori</th>
                  <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kategori as $i => $u)
            <tr class="data-row">
              <td class="align-middle iteration">{{ ++$i }}</td>
              <td class="align-middle id_barang">{{ $u->nama_kategori }}</td>
              <td>  
                <div class="row">
                   <a href="/kategori/edit/{{ $u->id_kategori}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                   {{-- <a href="/kategori/hapus/{{ $u->id_kategori }}" class="btn btn-danger btn-sm ml-2">Hapus</a> --}}
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
</div>

  <div id="tambah" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Masukan Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/kategori/store" method="post">
            {{ csrf_field() }}
          <div class="form-group">
              <label for="">Kategori</label>
              <input type="text" name="nama_kategori" class="form-control"  required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection