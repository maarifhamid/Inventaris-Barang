@extends('layouts.layout')
@section('content')
<title>Data Keranjang Barang Masuk</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Data Keranjang Barang Masuk</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    <a href="/keranjang_masuk/form_input" class="btn btn-success">Tambah Data</a>
      <br>
      <br>
      <table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>No</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tanggal Masuk</th>
                  <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($masuk as $i => $u)
            <tr class="data-row">
                  <td>{{++$i}}</td>
                  <td>{{$u->nama_barang}}</td>
                  <td>{{$u->jumlah_asup}}</td>
                  <td>{{$u->tanggal_masuk}}</td>
                  
              <td>  
                <div class="row">
                   <a href="/keranjang_masuk/edit/{{ $u->id_masuk }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                   <a href="javascript:void(0)" id="hapus" data-id="{{ $u->id_masuk }}" class="btn btn-danger btn-sm ml-2">Hapus</a>
                   <a href="/keranjang_masuk/detail_masuk/{{ $u->id_masuk }}" class="btn btn-warning btn-sm ml-2">Detail</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
  <div class="text-center">
  <a href="/inputmasuk" class="btn btn-dark">Masukan Semua Data</a>
  </div>
  <br>
   <font><b>*Mohon untuk langsung klik masukkan semua data untuk memasukan ke dalam data barang masuk</b></font>
</div>
  
@push('scripts')
    <script>
      $(document).on('click','#hapus',function(){
  var id = $(this).data("id");
  Swal.fire({
    title: 'Apakah Anda yakin?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Tidak'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "GET",
        url:  "/keranjang_masuk/hapus/"+id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: "id="+ id,
        success: function (data) {
        location.reload();
        Swal.fire(
          'Good job!',
          'Data Sukses Terhapus',
          'success'
        )
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
  });
});

    </script>
@endpush
  
@endsection