{{-- set layout dan konten --}}
@extends('layouts.layout')
@section('content')
{{-- library untuk buat sweet alert --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<title>Data Keranjang Keluar</title>

<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Data Keranjang Barang Keluar</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    {{-- buat error kalo ada masukan salah --}}
        @error('id_barang')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror 
    {{-- button tambah data --}}
    <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <br>
      <br>
      {{-- buat tabel --}}
      <table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>No</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tujuan</th>
                  <th>Tanggal Keluar</th>
                  <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            {{-- tampilkan data pada tabel --}}
            @foreach ($keluar as $i => $u)
            <tr class="data-row">
                  <td>{{++$i}}</td>
                  <td>{{$u->nama_barang}}</td>
                  <td>{{$u->jumlah_keluar}}</td>
                  <td>{{$u->untuk}}</td>
                  <td>{{$u->tanggal_keluar}}</td>
                  
              <td>  
                {{-- button edit dan hapus --}}
                <div class="row">
                   <a href="/keranjang_keluar/edit/{{ $u->id_keluar }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                   {{-- panggil javascript yakin hapus atau tidak --}}
                   <a href="javascript:void(0)" id="hapus" data-id="{{ $u->id_keluar }}" class="btn btn-danger btn-sm ml-2">Hapus</a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
  <div class="text-center">
    {{-- link mengarah ke input keluar jika masukan semua data --}}
  <a href="/inputkeluar" class="btn btn-dark">Masukan Semua Data</a>
  </div>
  {{-- keterangan --}}
  <br>
   <font><b>*Mohon untuk langsung klik masukkan semua data untuk memasukan ke dalam data barang keluar</b></font>
</div>

{{-- form tambah data --}}
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
          {{-- jalankan action --}}
        <form action="/keranjang_keluar/store" method="post" enctype="multipart/form-data">
            @csrf
         
            {{-- jika ingin tambah field --}}
          <div class="form-group">
             <div class="input_fields_wrap">
            <button class="add_field_button btn btn-primary">Add More Fields</button>
            <table>
              <tr>
                <td>
                  {{-- form --}}
                  <label for="">Nama Barang</label>
                      <select name="id_barang[]" class="myselect" style="width:200px">
                          <option selected disabled>Pilih Barang</option>
                          @foreach ($barang as $j)
                          <option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>
                          @endforeach  
                    </select>
                    </div>
                </td>
                <td>
                  <label for="">Jumlah</label>
                <input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required>
                </td>
              </tr>
            </table>
              
          </div>
          <div class="form-group">
                <label for="">Tujuan</label>
                <input type="text" name="untuk" class="form-control" required>
            </div>
           <div class="form-group">
                <label for="">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" required>
            </div>
             
        </div>
        {{-- button kembali dan simpan --}}
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  {{-- script untuk tambah field --}}
  @push('scripts')

  <script type="text/javascript">
        $(document).ready(function() {
	var max_fields      = 100; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
      x++; //text box increment
    
// tambah form bila tambah field
      $(wrapper).append('<div><table><tr><td><select name="id_barang[]" class="myselect" style="width:200px"><option selected disabled>Pilih Barang</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td style="padding-left:75px"><input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
      $('.myselect').select2();
		}
  });
  
// fungsi untuk hapus field kalau ga jadi tambah
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
  })
  
  
});


// fungsi apabila klik hapus, muncul pesan 
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
        url:  "/keranjang_keluar/hapus/"+id,
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