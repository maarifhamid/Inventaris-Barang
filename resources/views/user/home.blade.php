{{-- set layout dan konten --}}
@extends('layouts.layout')
@section('content')

<title>Dashboard</title>
</div>
{{-- set baris --}}
 <div class="row"> 
   {{-- buat kotak total barang --}}
   <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Barang</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung_barang}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-cube fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- buat kotak total barang rusak --}}
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Barang Rusak</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung_dalam + $hitung_luar  }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-trash-restore fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- buat kotak total barang masuk --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Total Barang Masuk</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung_masuk}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-boxes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- buat kotak total barang keluar -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Barang Keluar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung_keluar}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-box-open fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- buat kotak total peminjaman -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Peminjaman</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung_pinjam}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- buat kotak total barang ruangan -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Barang Ruangan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hitung_ruangan}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
 </div>
 {{-- bayangan --}}
 <div class="card shadow mb-4">

@endsection