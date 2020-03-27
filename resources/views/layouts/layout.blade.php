  <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  <!-- Custom fonts for this template -->
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.css">

  <!-- Custom styles for this page -->
  <link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sarpras Wikrama</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ (request()->is('home*')) ? 'active' : '' }}">
        <a class="nav-link " href="/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      @if (Auth::user()->level=='admin')

      <!-- Heading -->
      <div class="sidebar-heading">
        Data - data
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ (request()->is('barang*')) ? 'active' : '' }} {{ (request()->is('jenis*')) ? 'active' : '' }} {{ (request()->is('ruangan*')) ? 'active' : '' }}{{ (request()->is('kategori*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Data Master</span>
        </a>
        <div id="collapseTwo" class="collapse {{ (request()->is('barang*')) ? 'show' : '' }} {{ (request()->is('jenis*')) ? 'show' : '' }} {{ (request()->is('ruangan*')) ? 'show' : '' }} {{ (request()->is('kategori*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Master</h6>
            <a class="collapse-item {{ (request()->is('barang*')) ? 'active' : '' }}" href="{{url('barang')}}">Barang</a>
            <a class="collapse-item {{ (request()->is('ruangan*')) ? 'active' : '' }}" href="{{url('ruangan')}}">Ruangan</a>
            <a class="collapse-item {{ (request()->is('kategori*')) ? 'active' : '' }}" href="{{url('kategori')}}">Kategori</a>
          </div>
        </div>
      </li>


      <li class="nav-item {{ (request()->is('user*')) ? 'active' : '' }} {{ (request()->is('pj*')) ? 'active' : '' }} {{ (request()->is('rayon*')) ? 'active' : '' }} {{ (request()->is('bukan_pj*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
          <i class="fas fa-fw fa-user"></i>
          <span>Data User</span>
        </a>
        <div id="collapse0" class="collapse {{ (request()->is('user*')) ? 'show' : '' }} {{ (request()->is('pj*')) ? 'show' : '' }} {{ (request()->is('rayon*')) ? 'show' : '' }} {{ (request()->is('bukan_pj*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data User</h6>
            <a class="collapse-item {{ (request()->is('user*')) ? 'active' : '' }}" href="{{url('user')}}">Admin</a>
            <a class="collapse-item {{ (request()->is('rayon*')) ? 'active' : '' }}" href="{{url('rayon')}}">Pem. Rayon</a>
            <a class="collapse-item {{ (request()->is('pj*')) ? 'active' : '' }}" href="{{url('pj')}}">Pj Ruangan</a>
            <a class="collapse-item {{ (request()->is('bukan_pj*')) ? 'active' : '' }}" href="{{url('bukan_pj')}}">Bukan Pj</a>
          </div>
        </div>
      </li>

      {{-- <li class="nav-item {{ (request()->is('user*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('user')}}">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span></a> --}}
      </li>
      <!-- Nav Item - Charts -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('peminjaman')}}">
          <i class="fas fa-fw fa-briefcase"></i>
          <span>Peminjaman</span></a>
      </li> --}}

       <li class="nav-item {{ (request()->is('keranjang_peminjaman*')) ? 'active' : '' }} {{ (request()->is('peminjaman*')) ? 'active' : '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-briefcase"></i>
          <span>Peminjaman</span>
        </a>
        <div id="collapse1" class="collapse {{ (request()->is('keranjang_peminjaman*')) ? 'show' : '' }} {{ (request()->is('peminjaman*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Peminjaman</h6>
            <a class="collapse-item {{ (request()->is('keranjang_peminjaman*')) ? 'active' : '' }} " href="{{url('keranjang_peminjaman')}}">Keranjang Peminjaman</a>
            <a class="collapse-item {{ (request()->is('peminjaman*')) ? 'active' : '' }}" href="{{url('peminjaman')}}">Data Peminjaman</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Tables -->
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('input_ruangan')}}">
          <i class="fas fa-fw fa-university"></i>
          <span>Barang Ruangan</span></a>
      </li> --}}

      <li class="nav-item {{ (request()->is('keranjang_ruangan*')) ? 'active' : '' }} {{ (request()->is('input_ruangan*')) ? 'active' : '' }}">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-university"></i>
          <span>Barang Ruangan</span>
        </a>
        <div id="collapse2" class="collapse {{ (request()->is('keranjang_ruangan*')) ? 'show' : '' }} {{ (request()->is('input_ruangan*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Barang Ruangan</h6>
            <a class="collapse-item {{ (request()->is('keranjang_ruangan*')) ? 'active' : '' }} " href="{{url('keranjang_ruangan')}}">Keranjang ruangan</a>
            <a class="collapse-item {{ (request()->is('input_ruangan*')) ? 'active' : '' }}" href="{{url('input_ruangan')}}">Data Barang Ruangan</a>
          </div>
        </div>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('keluar')}}">
          <i class="fas fa-fw fa-paper-plane"></i>
          <span>Barang Keluar</span></a>
      </li> --}}

      <li class="nav-item {{ (request()->is('keranjang_keluar*')) ? 'active' : '' }} {{ (request()->is('keluar*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-paper-plane"></i>
          <span>Barang Keluar</span>
        </a>
        <div id="collapse3" class="collapse {{ (request()->is('keranjang_keluar*')) ? 'show' : '' }} {{ (request()->is('keluar*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Barang Keluar</h6>
            <a class="collapse-item {{ (request()->is('keranjang_keluar*')) ? 'active' : '' }} " href="{{url('keranjang_keluar')}}">Keranjang Keluar</a>
            <a class="collapse-item {{ (request()->is('keluar*')) ? 'active' : '' }}" href="{{url('keluar')}}">Data Keluar</a>
          </div>
        </div>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('masuk')}}">
          <i class="fas fa-fw fa-rocket"></i>
          <span>Barang Masuk</span></a>
      </li> --}}

       <li class="nav-item {{ (request()->is('keranjang_masuk*')) ? 'active' : '' }} {{ (request()->is('masuk*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-rocket"></i>
          <span>Barang Masuk</span>
        </a>
        <div id="collapse4" class="collapse {{ (request()->is('keranjang_masuk*')) ? 'show' : '' }} {{ (request()->is('masuk*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Barang Masuk</h6>
            <a class="collapse-item {{ (request()->is('keranjang_masuk*')) ? 'active' : '' }} " href="{{url('keranjang_masuk')}}">Keranjang Masuk</a>
            <a class="collapse-item {{ (request()->is('masuk*')) ? 'active' : '' }}" href="{{url('masuk')}}">Data Masuk</a>
          </div>
        </div>
      </li>

      <li class="nav-item {{ (request()->is('keranjang_rusak_ruangan*')) ? 'active' : '' }} {{ (request()->is('rusak_ruangan*')) ? 'active' : '' }}">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseb" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-suitcase"></i>
            <span>Barang Rusak Ruangan</span>
          </a>
          <div id="collapseb" class="collapse {{ (request()->is('keranjang_rusak_ruangan*')) ? 'show' : '' }}{{ (request()->is('rusak_ruangan*')) ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Barang Rusak Dalam</h6>
              <a class="collapse-item {{ (request()->is('keranjang_rusak_ruangan*')) ? 'active' : '' }}" href="{{url('keranjang_rusak_ruangan')}}">Keranjang Rusak Dalam</a>
              <a class="collapse-item {{ (request()->is('rusak_ruangan*')) ? 'active' : '' }}" href="{{url('rusak_ruangan')}}">Rusak Ruangan</a>
              </div>
          </div>
        </li>

        <li class="nav-item {{ (request()->is('keranjang_rusak_luar*')) ? 'active' : '' }} {{ (request()->is('rusak_luar*')) ? 'active' : '' }}">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsec" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Barang Rusak</span>
          </a>
          <div id="collapsec" class="collapse {{ (request()->is('keranjang_rusak_luar*')) ? 'show' : '' }}{{ (request()->is('rusak_luar*')) ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Barang Rusak Luar</h6>
              <a class="collapse-item {{ (request()->is('keranjang_rusak_luar*')) ? 'active' : '' }}" href="{{url('keranjang_rusak_luar')}}">Keranjang Rusak Luar</a>
              <a class="collapse-item {{ (request()->is('rusak_luar*')) ? 'active' : '' }}" href="{{url('rusak_luar')}}">Rusak Luar Ruangan</a>
              </div>
          </div>
        </li>

       <li class="nav-item {{ (request()->is('lap_barang_masuk*')) ? 'active' : '' }} {{ (request()->is('lap_barang_keluar*')) ? 'active' : '' }} {{ (request()->is('lap_barang_ruangan*')) ? 'active' : '' }} {{ (request()->is('lap_peminjaman*')) ? 'active' : '' }} {{ (request()->is('lap_rusak_rusak*')) ? 'active' : '' }} {{ (request()->is('lap_rusak_dalam*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-file"></i>
          <span>Laporan</span>
        </a>
        <div id="collapse5" class="collapse {{ (request()->is('lap_barang_masuk*')) ? 'show' : '' }}{{ (request()->is('lap_barang_keluar*')) ? 'show' : '' }} {{ (request()->is('lap_barang_ruangan*')) ? 'show' : '' }} {{ (request()->is('lap_peminjaman*')) ? 'show' : '' }} {{ (request()->is('lap_rusak_luar*')) ? 'show' : '' }} {{ (request()->is('lap_rusak_dalam*')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan</h6>
            <a class="collapse-item {{ (request()->is('lap_barang_masuk*')) ? 'active' : '' }}" href="{{url('lap_barang_masuk')}}">Barang Masuk</a>
            <a class="collapse-item {{ (request()->is('lap_barang_keluar*')) ? 'active' : '' }}" href="{{url('lap_barang_keluar')}}">Barang Keluar</a>
            <a class="collapse-item {{ (request()->is('lap_peminjaman*')) ? 'active' : '' }}" href="{{url('lap_peminjaman')}}">Data Peminjaman</a>
            <a class="collapse-item {{ (request()->is('lap_barang_ruangan*')) ? 'active' : '' }}" href="{{url('lap_barang_ruangan')}}">Barang Ruangan</a>
            <a class="collapse-item {{ (request()->is('lap_rusak_luar*')) ? 'active' : '' }}" href="{{url('lap_rusak_luar')}}">Barang Rusak Luar</a>
            <a class="collapse-item {{ (request()->is('lap_rusak_dalam*')) ? 'active' : '' }}" href="{{url('lap_rusak_dalam')}}">Barang Rusak Dalam</a>
          </div>
        </div>
      </li>
                
     

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      @elseif(Auth::user()->level=='rayon' || Auth::user()->level=='pj')
      <div class="sidebar-heading">
        Data - data
      </div>
        <li class="nav-item {{ (request()->is('pembimbing*')) ? 'active' : '' }}">
          <a class="nav-link " href="/pembimbing">
            <i class="fas fa-fw fa-university"></i>
            <span>Barang Ruangan</span></a>
        </li>
         <li class="nav-item {{ (request()->is('input_rusak_dalam*')) ? 'active' : '' }} {{ (request()->is('input_rusak_luar*')) ? 'active' : '' }}">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsea" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-suitcase"></i>
            <span>Input Barang Rusak</span>
          </a>
          <div id="collapsea" class="collapse {{ (request()->is('input_rusak_dalam*')) ? 'show' : '' }}{{ (request()->is('input_rusak_luar*')) ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Barang Rusak</h6>
              <a class="collapse-item {{ (request()->is('input_rusak_dalam*')) ? 'active' : '' }}" href="{{url('input_rusak_dalam')}}">Dalam Ruangan</a>
              <a class="collapse-item {{ (request()->is('input_rusak_luar*')) ? 'active' : '' }}" href="{{url('input_rusak_luar')}}">Luar Ruangan</a>
              </div>
          </div>
        </li>
      @else
        <li class="nav-item {{ (request()->is('input_rusak_dalam*')) ? 'active' : '' }} {{ (request()->is('input_rusak_luar*')) ? 'active' : '' }}">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsea" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-suitcase"></i>
            <span>Input Barang Rusak</span>
          </a>
          <div id="collapsea" class="collapse {{ (request()->is('input_rusak_dalam*')) ? 'show' : '' }}{{ (request()->is('input_rusak_luar*')) ? 'show' : '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Barang Rusak</h6>
              <a class="collapse-item {{ (request()->is('input_rusak_dalam*')) ? 'active' : '' }}" href="{{url('input_rusak_dalam')}}">Dalam Ruangan</a>
              <a class="collapse-item {{ (request()->is('input_rusak_luar*')) ? 'active' : '' }}" href="{{url('input_rusak_luar')}}">Luar Ruangan</a>
              </div>
          </div>
        </li>
      @endif

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="group">
                <div class="mr-2">
                    {{ Carbon\Carbon::now()->format('l, d F Y')}}
                </div>
              </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/change-password">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            @yield('content')
            

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin akan log out ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Logout" jika anda ingin keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="btn btn-dark" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Bootstrap core JavaScript-->
  
  <script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('assets/js/demo/datatables-demo.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $('.myselect').select2();
  </script>


  @stack('scripts')
  @include('sweet::alert')
</body>

</html>
