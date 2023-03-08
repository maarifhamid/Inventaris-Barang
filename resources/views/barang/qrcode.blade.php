{{-- setting layout dan konten --}}
@extends('layouts.layout')
@section('content')

<title>Data Barang</title>
{{-- panggil library yg digunakan --}}
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">QRCode</h6>
</div>
<div class="card-body text-center">
 <h3>QR Code <br> {{$qrcode->nama_barang}}</h3>
 <div id="example">
   {{-- membuat qrCode format png yg berisi id_barang --}}
  <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(150)->errorCorrection('H')
                        ->generate($qrcode->id_barang))!!}"> 
                        <!-- ->generate($qrcode->nama_barang . ' Kantor Camat Kotabaru Kota Jambi'))
                        !!}"> -->
                        
                        </div> 
                        <br>
{{-- button print qrCode --}}
<input type="button" value="Print" class="btn btn-primary" onclick="printDiv(example);"/>
</div>

{{-- print menggunakan jscript --}}
<script>
function printDiv(example) {
      var printContents = document.getElementById("example").innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>

@endsection