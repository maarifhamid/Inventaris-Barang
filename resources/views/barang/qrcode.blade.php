@extends('layouts.layout')
@section('content')
<title>Data Barang</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">QRCode</h6>
</div>
<div class="card-body text-center">
 <h3>QR Code <br> {{$qrcode->nama_barang}}</h3>
  <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(150)->errorCorrection('H')
                        ->generate($qrcode->id_barang)) !!} ">
</div>

@endsection