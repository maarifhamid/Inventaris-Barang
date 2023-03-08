
<!DOCTYPE html>
<html lang="en">

<head>
{{-- Mengatur tampilan website --}}
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  {{-- menyesuaikan tampilan device --}}
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  <meta name="description" content="">
  <meta name="author" content="">
<style>
.body{
  /* background ruangan kantor camat */
    background-image: url("/assets/img/Login_Simasku.jpg"); 
    /* size cover --> biar layar penuh*/
    background-size: cover;
}
/* buat kotak loginnya */
.card{
        background: #fbfbfb;
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 410px;
        margin: 6rem auto 8.1rem auto;
        width: 400px;
}
/* garis bawah dijudul warna hijau */
.underline-title {
      background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
      height: 2px;
      margin: -1.1rem auto 0 auto;
      width: 89px;
}

</style>

  {{-- <title>SIMAS KAMATARU - Login</title> --}}

  <!-- font template -->
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet')}}" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- style template pakai sb-admin2 -->
  <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
<!-- panggil warna background -->
<body class="body"> 

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
             
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    {{-- <h1 class="h4 text-gray-900 mb-4">SIMAS KAMATARU</h1> --}}
                  </div>
      {{-- memanggil route login dengan method post --}}
     <form action="{{ route('login') }}" method="POST"  id="login_form" class="request-form ">
      {{-- csrff = memberikan perlindungan dengan serangan CSRF dengan menghasilkan token CSRF --}}
      @csrf
      {{-- tulisan login dengan underline --}}
      <h1 class="h4 text-gray-900 mb-4" style="text-align:center">Login</h1>
      <div class="underline-title"></div>
      <div id="show_error" style="color: red"> </div>

      {{-- kotak username --}}
     <div class="form-group mr-0.9">
        <label for="" class="label">Username :</label>
        <input type="username" name="username" class="form-control" placeholder="Masukkan Username" >
        <span class="text-danger error-text username_error" 
         style="color: red"></span>
     </div>
  
     {{-- kotak password --}}
     <div class="form-group mr-0.9">
        <label for="" class="label">Password :</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
        <span class="text-danger error-text password_error" 
        style="color: red"></span>
     </div>
  
     {{-- tombol login warna hijau --}}
     <div class="form-group">
     <input type="submit" value="Login" class="btn btn-success btn-user btn-block">
     </div>
    </form>
  </div>

  </body>