@extends('layouts.layout')
@section('content')
<title>Keranjang Barang Rusak Ruangan</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Keranjang Barang Rusak Ruangan</h6>
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
                  <th>Penginput</th>
                  <th>Barang</th>
                  <th>Jumlah Rusak</th>
                  <th>Ruangan</th>
                  <th>Tanggal Rusak</th>
                  <th>Status</th>
                  <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($rusak as $i => $u)
            <tr>
                  <td>{{++$i}}</td>
                  <td>{{$u->name}}</td>
                  <td>{{$u->nama_barang}}</td>
                  <td>{{$u->jumlah_rusak_ruangan}}</td>
                  <td>{{$u->ruangan}}</td>
                  <td>{{$u->tanggal_rusak}}</td>
                  <td>{{$u->status}}</td>
              <td>  
                <div class="row">
                   <a href="/keranjang_rusak_ruangan/edit/{{ $u->id_rusak_ruangan }}" class="btn btn-primary btn-sm ml-2">Edit</a>
                   <a href="javascript:void(0)" id="hapus" data-id="{{ $u->id_rusak_ruangan }}" class="btn btn-danger btn-sm ml-2">Hapus</a>
                   
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
  <div class="text-center">
  <a href="/inputrusakruangan" class="btn btn-dark">Masukan Semua Data</a>
  </div>
  <br>
   <font><b>*Mohon untuk langsung klik masukkan semua data untuk memasukan ke dalam data rusak ruangan</b></font>
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
        <form action="/keranjang_rusak_ruangan/store" method="post">
            @csrf
             <div class="form-group">
              <label for="">Ruangan</label>
              <select name="id_ruangan" id="" class="myselect" style="width:100%" required>
                  <option selected disabled value="">Pilih Ruangan</option>
                  @foreach ($ruangan as $j)
                  <option value="{{$j->id_ruangan}}">{{$j->ruangan}}</option>
                  @endforeach  
              </select>
          </div>
         
          <div class="form-group">
             <div class="input_fields_wrap">
            <button class="add_field_button btn btn-primary">Add More Fields</button>
            <table>
              <tr>
                <td>
                  <label for="">Nama Barang</label>
                      <select name="id_barang[]" id="" class="myselect" required style="width:200px">
                          <option selected disabled value="">Pilih Jenis Barang</option>
                          @foreach ($barang as $j)
                          <option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>
                          @endforeach  
                    </select>
                    </div>
                </td>
                <td class="pl-3">
                  <label for="">Jumlah Rusak</label>
                <input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required>
                </td>
              </tr>
            </table>
              
          </div>
           <div class="form-group">
                <label for="">Tanggal Rusak</label>
                <input type="date" name="tanggal_rusak" class="form-control" required>
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
      
      $(wrapper).append('<div><table><tr><td><select name="id_barang[]" id="" class="myselect" style="width:200px" required><option selected disabled value="">Pilih Jenis Barang</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td style="padding-left:75px"><input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
      $('.myselect').select2();
		}
  });
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

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
        url:  "/keranjang_rusak_ruangan/hapus/"+id,
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