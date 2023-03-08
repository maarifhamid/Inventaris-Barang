@extends('layouts.layout')
@section('content')
<title>Dashboard</title>
<div class="card-header">
     @if (Auth::user()->level=='kasi')
        Dashboard KASI
    {{-- @elseif(Auth::user()->level=='pegawai')
        Dashboard Pegawai --}}
    @else
        Dashboard Pegawai
    @endif
</div>
<div class="card-body">
    <h1 align="center">SIMASKU</h1>
</div>
@endsection