{{-- set layout dan konten --}}
@extends('layouts.layout')
@section('content')
<title>Data Barang Keluar</title>
{{-- library yang dibutuhkan --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</div>
{{-- baris --}}
 <div class="row"> 
   {{-- buat kotak total jumlah barang keluar --}}
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Jumlah Barang Keluar</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$keluar}}</div>
          </div>
          <div class="col-auto">
            {{-- icon --}}
            <i class="fas fa-box-open fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- buat kotak total bareang keluar --}}
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Data Barang Keluar</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung}}</div>
          </div>
          <div class="col-auto">
            {{-- icon --}}
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
 <div class="card shadow mb-4">
{{-- card header --}}
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Data Barang Keluar</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
    {{-- <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
      <br>
      <br> --}}
       <a href="/keluar/export_excel" class="btn btn-warning my-3" target="_blank">EXPORT EXCEL</a>
      
       {{-- buat tabel --}}
      <table id="example" class="table table-bordered js-basic-example dataTable" cellspacing="0">
          <thead>
            <tr>
            
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tujuan</th>
                  <th>Tanggal Keluar</th>
                  <th>Opsi</th>
            </tr>
          </thead>
        
        </table>
  </div>
</div>

{{-- form tambah barang keluar --}}
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
          {{-- panggil route --}}
        <form action="/keluar/store" method="post" enctype="multipart/form-data">
            @csrf
         
          <div class="form-group">
            {{-- kalo mau tambah field barang --}}
             <div class="input_fields_wrap">
            <button class="add_field_button btn btn-primary">Add More Fields</button>
            <table>
              <tr>
                <td>
                  {{-- form tambah barang keluar --}}
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
                <label for="">Tujuan</label>
                <input type="text" name="untuk" class="form-control" required>
            </div>
           <div class="form-group">
                <label for="">Tanggal Keluar</label>
                <input type="date" name="tanggal_keluar" class="form-control" required>
            </div>
             
        </div>
        {{-- button keluar dan simpan --}}
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
      
      // buat form lagi
			$(wrapper).append('<div><table><tr><td><select name="id_barang[]" id="" class="form-control"><option selected disabled>-----Pilih Jenis Barang-----</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td class="pl-3"><input type="number" name="jumlah[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
		}
  });
  

	// hapus field kalo ga jadi tambah
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

</script>

  @endpush

  {{-- tampilkan data ke tabel --}}
   <script>
 $(document).ready( function () {
    $('#example').DataTable({
           processing: true,
           serverSide: true,
           ajax: "/keluar_json",
           columns: [
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'jumlah_keluar', name: 'jumlah_keluar' },
                    { data: 'untuk', name: 'untuk' },
                    { data: 'tanggal_keluar', name: 'tanggal_keluar' },
                    { data: 'action', name: 'action', orderable: false},
                 ]
        });
     });
</script>
  
@endsection