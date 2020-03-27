@extends('layouts.layout')
@section('content')
<title>Data Barang</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</div>
 <div class="row"> 
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Barang</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$barang}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa fa-book fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Jumlah Barang</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-file fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
 <div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Data Barang</h6>
</div>

<div class="card-body">
   
  <div class="table-responsive">
    <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <br>
      <br>
      <table id="example" class="table table-bordered js-basic-example dataTable" cellspacing="0">
          <thead>
            <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
                  <th>Jumlah Baik</th>
                  <th>Jumlah Rusak</th>
                  <th>Total</th>
                  <th>Opsi</th>
            </tr>
          </thead>
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
        <form action="{{ route('barang.store') }}" method="post">
            @csrf
          <div class="form-group">
              <label for="">Kode Barang</label>
              <input type="text" name="id_barang" class="form-control"  required>
          </div>
          <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang" required>
          </div>
          <div class="form-group">
                <label for="">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                  <option value="" selected disabled>Pilih Kategori</option>
                   @foreach ($kategori as $k)
                    <option value="{{$k->id_kategori}}">{{$k->nama_kategori}}</option>
                   @endforeach
                </select>
          </div>
          <div class="form-group">
              <label for="">Satuan</label>
              <input type="text" name="satuan" class="form-control" placeholder="Masukan Satuan" required>
          </div>
          <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required placeholder="Masukan Jumlah Barang" required>
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

  <script>
 $(document).ready( function () {
    $('#example').DataTable({
           processing: true,
           serverSide: true,
           ajax: "/barang_json",
           columns: [
                    { data: 'id_barang', name: 'id_barang' },
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'nama_kategori', name: 'nama_kategori' },
                    { data: 'satuan', name: 'satuan' },
                    { data: 'jumlah', name: 'jumlah' },
                    { data: 'jumlah_rusak', name: 'jumlah_rusak' },
                     { data: 'total', name: 'total' },
                    {data: 'action', name: 'action', orderable: false},
                 ]
        });
     });
</script>
@endsection