@extends('layouts.layout') @section('content')
<title>Input Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Input Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/keranjang_masuk/store" method="post">
            @csrf
         
          <div class="form-group">
            <label for="">Nama Barang</label>
                       <select name="id_barang" class="myselect" style="width:100%">
                          <option selected disabled>Pilih Barang</option>
                          @foreach ($barang as $j)
                          <option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>
                          @endforeach  
                    </select>
          </div>
           
             <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" id="txt1[]" onkeyup="sum();" class="form-control" required placeholder="Masukan Jumlah" required>
             </div>
                                    
             <div class="form-group">
 <label for="">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="txt2[]" onkeyup="sum();" class="form-control" required placeholder="Masukan Jumlah" required>
                
             </div>
                   
             <div class="form-group">
<label for="">Harga Total</label>
                    <input type="number" name="harga_total" id="txt3[]" readonly class="form-control" required placeholder="Masukan Jumlah" required>
                
             </div>
                    
             <div class="form-group">
<label for="">Nama Toko</label>
                    <input type="text" name="nama_toko" class="form-control" required placeholder="Masukan Jumlah" required>
                
             </div>
                    
             <div class="form-group">
<label for="">Merek</label>
                    <input type="text" name="merek" class="form-control" required placeholder="Masukan Jumlah" required>
                
             </div>
                    
              
          <div class="form-group">
              <label for="">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" required placeholder="Masukan Sumber dana" required>
          </div>
           <div class="form-group">
                <label for="">Tanggal masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" required>
            </div>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
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
      
			$(wrapper).append('<div><table><tr><td><select name="id_barang[]" id="" class="form-control"><option selected disabled>-----Pilih Jenis Barang-----</option>@foreach ($barang as $j)<option value="{{$j->id_barang}}">{{$j->nama_barang}}</option>@endforeach</select></div></td><td class="pl-2"><input type="number" name="jumlah[]" id="txt1[]" onkeyup="sum();" class="form-control" required placeholder="Masukan Jumlah" required></td><td class="pl-2"><input type="number" name="harga_satuan[]" id="txt2[]" onkeyup="sum();" class="form-control" required placeholder="Masukan Jumlah" required></td><td class="pl-2"><input type="number" name="harga_total[]" id="txt3[]" class="form-control" required placeholder="Masukan Jumlah" required></td><td class="pl-2"><input type="text" name="nama_toko[]" class="form-control" required placeholder="Masukan Jumlah" required></td><td class="pl-2"><input type="text" name="merek[]" class="form-control" required placeholder="Masukan Jumlah" required></td></tr></table><a href="#" class="remove_field">Remove</a></div>');
		}
  });
  

	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

function sum() {
      var txtFirstNumberValue = document.getElementById('txt1[]').value;
      var txtSecondNumberValue = document.getElementById('txt2[]').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('txt3[]').value = result;
      }
}

</script>

  @endpush
  
@endsection