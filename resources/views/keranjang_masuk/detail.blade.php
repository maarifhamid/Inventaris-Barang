@extends('layouts.layout')
@section('content')
<title>Data Barang</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Detail</h6>
</div>
<div class="card-body">
    <table>
        <tr>
            <td>Barang</td>
            <td>:</td>
            <td>{{$masuk->nama_barang}}</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>{{$masuk->jumlah_asup}}</td>
        </tr>
        <tr>
            <td>Harga Satuan</td>
            <td>:</td>
            <td>Rp.{{$masuk->harga_satuan}}</td>
        </tr>
        <tr>
            <td>Harga Total</td>
            <td>:</td>
            <td>Rp.{{$masuk->harga_total}}</td>
        </tr>
        <tr>
            <td>Nama Toko</td>
            <td>:</td>
            <td>{{$masuk->nama_toko}}</td>
        </tr>
        <tr>
            <td>Merek</td>
            <td>:</td>
            <td>{{$masuk->merek}}</td>
        </tr>
        <tr>
            <td>Sumber Dana</td>
            <td>:</td>
            <td>{{$masuk->sumber_dana}}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{$masuk->tanggal_masuk}}</td>
        </tr>
    </table>
</div>

@endsection