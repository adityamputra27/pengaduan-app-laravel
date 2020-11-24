<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>{{ $check_user != 0 ? 'Pengaduan | Admin | Login' : 'Pengaduan | Admin | Register' }}</title>
  <link href="{{ asset('assets') }}/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('assets') }}/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets') }}/admin/sweetalert/sweetalert2.scss">
  <style>
      .margin-top-login
      {
        margin-top: 70px;
      }
      .margin-top-register
      {
        margin-top: 20px;
      }
      .bg-login
      {
        background-position: center;
        background-image: url('{{ asset('assets/admin/img/login-illustrations.png') }}');
        background-size: cover;
      }
      .bg-register
      {
        background-position: center;
        background-image: url('{{ asset('assets/admin/img/register-illustrations.png') }}');
        background-size: 100%;
        background-repeat: no-repeat;
      }
  </style>
</head>
<body class="bg-gradient-success">
  <div class="container">
    <div class="row justify-content-center">
    @if($check_user != 0)
      <div class="col-xl-10 col-lg-12 col-md-9 margin-top-login">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login - Pengaduan App</h1>
                  </div>
                  @include('components.admin.feedback.index')
                  <form class="user" method="POST" action="{{ route('admin.verify_login') }}">
                    @csrf
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user"placeholder="Masukkan Username" value="{{ old('username') }}">
                      @error('username') <b class="text-danger">{{ $message }}</b> @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan Password" value="{{ old('password') }}">
                      @error('password') <b class="text-danger">{{ $message }}</b> @enderror
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Lihat Password</label>
                      </div>
                    </div>
                    <button class="btn btn-success btn-user btn-block" type="submit">
                      <i class="fa fa-sign-in"></i> Login
                    </button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="col-xl-10 col-lg-12 col-md-9 margin-top-register">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-register"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900">Selamat Datang</h1>
                    <h1 class="h6 text-gray-900">Silahkan Registrasi Untuk Akun Administrator</h1>
                  </div>
                  @include('components.admin.feedback.index')
                  <form class="user" action="{{ route('admin.first_account') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="text" name="nama_petugas" class="form-control form-control-user" id="nama_petugas" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_petugas') }}">
                      @error('nama_petugas') <b class="text-danger">{{ $message }}</b> @enderror
                    </div>
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Masukkan Username" value="{{ old('username') }}">
                      @error('username') <b class="text-danger">{{ $message }}</b> @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Masukkan Password" value="{{ old('password') }}">
                      @error('password') <b class="text-danger">{{ $message }}</b> @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password_confirmation" class="form-control form-control-user" id="password" placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Lihat Password</label>
                      </div>
                    </div>
                    <button id="register" class="btn-register btn btn-success btn-user btn-block"><i class="fa fa-sign-in"></i> 
                      Buat Akun!
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      </div>
    </div>
  </div>
  <script src="{{ asset('assets') }}/admin/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{ asset('assets') }}/admin/js/sb-admin-2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{ asset('assets') }}/admin/js/custom.js"></script>
  <script>
    @if ($message = Session::get('success'))
    Swal.fire({
      icon: 'success',
      title: '{{ $message }}',
      text: 'Klik Dimana Saja Untuk Menghilangkan Notifikasi Ini!',
      showConfirmButton: false,
      timer: 4000
    });
    @endif
    @if ($message = Session::get('error'))
    Swal.fire({
      icon: 'error',
      title: '{{ $message }}',
      text: 'Klik Dimana Saja Untuk Menghilangkan Notifikasi Ini!',
      showConfirmButton: false,
      timer: 4000
    });
    @endif
  </script>
</body>
</html>
