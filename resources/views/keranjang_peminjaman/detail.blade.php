@extends('layouts.layout') @section('content')
<title>Detail Peminjaman</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Detail Peminjaman</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <table>
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>:</th>
                    <td>{{$peminjaman2->nama_peminjam}}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <th>:</th>
                     @foreach ($barang as $r)
                     @if ($peminjaman2->id_barang==$r->id_barang)
                    <td>{{$r->nama_barang}}</td>
                    @endif
                    @endforeach
                </tr>
                 <tr>
                    <th>Jumlah</th>
                    <th>:</th>
                    <td>{{$peminjaman2->jumlah_pinjam}}</td>
                </tr>
                <tr>
                    <th>Tanggal Peminjaman</th>
                    <th>:</th>
                    <td>{{$peminjaman2->tanggal_pinjam}}</td>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                    <th>:</th>
                    <td>{{$peminjaman2->tanggal_kembali}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>:</th>
                    <td>{{$peminjaman2->status}}</td>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection