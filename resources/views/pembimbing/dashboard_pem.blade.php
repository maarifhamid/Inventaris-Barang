@extends('layouts.layout')
@section('content')
<title>Dashboard</title>
<div class="card-header">
     @if (Auth::user()->level=='rayon')
        Dashboard Pembimbing
    @elseif(Auth::user()->level=='pj')
        Dashboard Pj Ruangan
    @else
        Dashboard
    @endif
</div>
<div class="card-body">
    <h1 align="center">Sistem Manajemen Sarana & Prasarana</h1>
</div>
@endsection