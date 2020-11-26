<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Dashboard {{ Str::ucfirst(Auth::guard('petugas')->user()->role) }}</title>
  <link href="{{ asset('assets') }}/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('assets') }}/admin/css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/sweetalert/sweetalert2.scss">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/vendor/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-text mx-3">Pengaduan-App</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a href="" class="nav-link">
          <img class="img-profile rounded-circle" src="{{ asset('assets/admin/uploads/' . Auth::guard('petugas')->user()->avatar) }}">
          <span>{{ Str::upper(Auth::guard('petugas')->user()->role) }}</span></a>
        </a>
      </li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('app') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      @if(Auth::guard('petugas')->user()->role == 'admin')
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        MENU
      </div>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('kelola_masyarakat') }}">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Masyarakat</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('petugas_home') }}">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Petugas</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#dropdownAspirasi" aria-expanded="true" aria-controls="dropdownAspirasi">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Aspirasi</span>
        </a>
        <div id="dropdownAspirasi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Lihat Aspirasi</a>
            <a class="collapse-item" href="#">Tanggapan Aspirasi</a>
            <a class="collapse-item" href="#">Aspirasi yang Di Tolak</a>
          </div>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#dropdownAduan" aria-expanded="true" aria-controls="dropdownAduan">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Aduan</span>
        </a>
        <div id="dropdownAduan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('kelola_aduan') }}">Lihat Aduan</a>
            <a class="collapse-item" href="{{ route('kelola_tanggapan') }}">Tanggapan Aduan</a>
            <a class="collapse-item" href="{{ route('aduan_tolak') }}">Aduan yang Di Tolak</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('kategori') }}">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Kategori</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        FITUR LAINNYA
      </div>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('laporan_home') }}">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Laporan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('edit_profile', Auth::guard('petugas')->user()->id) }}">
          <i class="fas fa-fw fa-edit"></i>
          <span>Edit Profile</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('history_login') }}" class="nav-link">
          <i class="fas fa-fw fa-history"></i>
          <span>History Login</span>
        </a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">
      @elseif(Auth::guard('petugas')->user()->role == 'petugas')
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        MENU
      </div>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Data Aduan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('kelola_aduan') }}">Lihat Aduan</a>
            <a class="collapse-item" href="{{ route('kelola_tanggapan') }}">Tanggapan Aduan</a>
            <a class="collapse-item" href="{{ route('aduan_tolak') }}">Aduan yang Di Tolak</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        FITUR LAINNYA
      </div>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('edit_profile', Auth::guard('petugas')->user()->id) }}">
          <i class="fas fa-fw fa-edit"></i>
          <span>Edit Profile</span></a>
      </li>
      @endif
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Sesuatu..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">Anda Login Sebagai : {{ Str::upper(Auth::guard('petugas')->user()->role) }}</span>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Sesuatu..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang, {{ Auth::guard('petugas')->user()->nama_petugas }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('assets/admin/uploads/' . Auth::guard('petugas')->user()->avatar) }}">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
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
        @yield('content')
        @include('components.admin.templates.footer')