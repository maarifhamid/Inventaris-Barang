{{-- set layout dan content --}}
@extends('layouts.layout') @section('content')
<title>Change Password</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Ubah Password</h6>
</div>
<div class="card-body">
    <div class="x_content">
        {{-- panggil route ubah password --}}
        <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
                        {{-- form ubah password --}}
                        <div class="form-group row">
                            {{-- label --}}
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Saat Ini</label>
                            {{-- kotak form --}}
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Konfirmasi Password Baru</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{-- tombol button update --}}
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </div>
                    </form>

</div>
@endsection