{{-- layout dan konten --}}
@extends('layouts.layout')
@section('content')
<title>Keranjang Data Peminjaman</title>
{{-- library yg digunakan untuk buat pesan sweetalert --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Keranjang Data Peminjaman</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    {{-- button tambah data --}}
    <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <br>
      <br>
      {{-- tabel --}}
      <table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>No</th>
                  <th>Nama Peminjam</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
                  <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            {{-- tampilkan data pada tabel --}}
            @foreach ($peminjaman as $i => $u)
            <tr class="data-row">
                  <td>{{++$i}}</td>
                  <td>{{$u->nama_peminjam}}</td>
                  <td>{{$u->nama_barang}}</td>
                  <td>{{$u->jumlah_pinjam}}</td>
                  <td>{{$u->tanggal_pinjam}}</td>
                  <td>{{$u->tanggal_kembali}}</td>
                  <td>{{$u->status}}</td>
              <td>  
                <div class="row">
                  {{-- button edit dan hapus --}}
                      <a href="/keranjang_peminjaman/edit/{{ $u->id_peminjaman }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                      {{-- apabila klik hapus maka jalankan javascript --}}
                      <a href="javascript:void(0)" id="hapus" data-id="{{ $u->id_peminjaman }}" class="btn btn-danger btn-sm ml-2">Hapus</a>
                      

                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
  <div class="text-center">
    {{-- link apabila masukan semua data --}}
  <a href="/inputpeminjaman" class="btn btn-dark">Masukan Semua Data</a>
  </div>
  <br>
  {{-- keterangan --}}
   <font><b>*Mohon untuk langsung klik masukkan semua data untuk memasukan ke dalam data peminjaman</b></font>
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
        <form action="/keranjang_peminjaman/store" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
              <label for="">Nama Peminjaman</label>
              <input type="text" name="nama_peminjaman" class="form-control"  required>
          </div>
          <div class="form-group">
            {{-- button tambah field --}}
             <div class="input_fields_wrap">
            <button class="add_field_button btn btn-primary">Add More Fields</button>
            <table>
              <tr>
                <td>
                  {{-- form --}}
                  <label for="">Nama Barang</label>
                      <select name="id_barang[]" id="" class="myselect" style="width:200px">
                          <option selected disabled>Pilih Barang</option>
                          @foreach ($barang as $j)
                          <option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>
                          @endforeach  
                    </select>
                    </div>
                </td>
                <td class="pl-3">
                  <label for="">Jumlah</label>
                <input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required>
                </td>
              </tr>
            </table>
              
          </div>
          <div class="form-group">
                </div>

           <div class="form-group">
                <label for="">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>
             <div class="form-group">
                <label for="">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  {{-- script tambah field --}}
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
      
      // tambahkan form
			$(wrapper).append('<div><table><tr><td><select name="id_barang[]" id="" class="myselect"><option selected disabled>-----Pilih Jenis Barang-----</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td style="padding-left:73px"><input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
      $('.myselect').select2();
    }
  });
  // fungsi untuk hapus field
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

// fungsi ubah status
    $( "#status" ).change(function() { 
        var id =$("#hid").val();
        var status =$("#status").val();
        console.log(status + " " + id);
        $.ajax({
            type: "GET",
            url: "update/"+ id + "status/" + status,
            success: function(data){
            console.log(data);
            $("#update").val(data);
            },
        });
    });

// fungsi pesan hapus
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
        url:  "/keranjang_peminjaman/hapus/"+id,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: "id="+ id,
        success: function (data) {
           Swal.fire(
          'Good job!',
          'Data Sukses Terhapus',
          'success'
        )
        location.reload();
       
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