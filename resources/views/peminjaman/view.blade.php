@extends('layouts.layout')
@section('content')
<title>Data Peminjaman</title>
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
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total yang di pinjam</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$peminjaman2}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-box fa-2x text-gray-300"></i>
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
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Peminjaman</div>
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
  <h6 class="m-0 font-weight-bold text-dark">Data Peminjaman</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    {{-- <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>--}}
    <a href="/peminjaman/export_excel" class="btn btn-warning my-3" target="_blank">EXPORT EXCEL</a>
      <br>
      <br> 
     <table id="example" class="table table-bordered js-basic-example dataTable" cellspacing="0">
          <thead>
            <tr>
                  
                  <th>Nama Peminjam</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
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
        <form action="/peminjaman/store" method="post">
            @csrf
             <div class="form-group">
              <label for="">No Peminjaman</label>
              <input type="text" name="no_peminjaman" class="form-control"  required>
          </div>
          <div class="form-group">
              <label for="">Nama Peminjaman</label>
              <input type="text" name="nama_peminjaman" class="form-control"  required>
          </div>
          <div class="form-group">
             <div class="input_fields_wrap">
            <button class="add_field_button btn btn-primary">Add More Fields</button>
            <table>
              <tr>
                <td>
                  <label for="">Nama Barang</label>
                      <select name="id_barang[]" id="" class="form-control">
                          <option selected disabled>-----Pilih Jenis Barang-----</option>
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
      
			$(wrapper).append('<div><table><tr><td><select name="id_barang[]" id="" class="form-control"><option selected disabled>-----Pilih Jenis Barang-----</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td class="pl-3"><input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
		}
  });
  

	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

</script>

  @endpush
<script>
 $(document).ready( function () {
    $('#example').DataTable({
           processing: true,
           serverSide: true,
           ajax: "/peminjaman_json",
           columns: [
                    { data: 'nama_peminjam', name: 'nama_peminjam' },
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'jumlah_pinjam', name: 'jumlah_pinjam' },
                    { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                    { data: 'status', name: 'status' },
                    {data: 'action', name: 'action', orderable: false},
                 ]
        });
     });
</script>
  
@endsection