@extends('components.user.layout.header')
@section('section-hero')
<div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
    <div>
    <h1>Register</h1>
    </div>
</div>
<div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
    <img src="{{ asset('assets') }}/img/register-user.svg" class="img-fluid" alt="">
</div>
@endsection
@section('content-user')
<section id="register">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-success">Silahkan Isi Data Dengan Lengkap.</h4>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <span class="fa fa-check-circle"></span> {{ $message }}
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            <span class="fa fa-close"></span> {{ $message }}
                        </div>
                        @endif
                        <form action="{{ route('register_account') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="text-success" for="">Nomor Induk Kependudukan (NIK)</label>
                                <input type="number" name="nik" class="form-control" value="{{ old('nik') }}" autofocus>
                                <span class="text-danger">@error('nik'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label class="text-success" for="">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}">
                                <span class="text-danger">@error('nama_lengkap'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label class="text-success" for="">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                                <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-success">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password-1" name="password" class="form-control" value="{{ old('password') }}">     
                                    <div class="input-group-append" id="toggle-1">
                                        <button class="btn btn-success" id="btn-1" type="button"><span class="fa fa-eye"></span></button>
                                    </div>
                                </div>
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-success">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" id="password-2" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                                    <div class="input-group-append" id="toggle-2">
                                        <button class="btn btn-success" id="btn-2" type="button"><span class="fa fa-eye"></span></button>
                                    </div>
                                </div>
                                <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label class="text-success" for="">No Telepon.</label>
                                <input type="text" name="telp" class="form-control"  value="{{ old('telp') }}">
                                <span class="text-danger">@error('telp'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><span class="bx bx-send"></span> Register</button>
                            </div>
                            <div class="form-group">
                                <p>Sudah Punya Akun? Login <a href="{{ route('user.login') }}">Disini!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('nav-user')
<li class="active"><a href="{{ url('') }}">Beranda</a></li>
@endsection
@push('javascript')
<script>
    $(document).ready(function (){
        $('#password-1 button').on('click', function() {
            if ($('#password-1 input').attr('type') === 'text') {
                $('#password-1 input').attr('type', 'password');
                $('#password-1 i').addClass('fa-eye-slash');
                $('#password-1 i').removeClass('fa-eye');
            } 
            else {
                $('#password-1 input').attr('type', 'text');
                $('#password-1 i').removeClass('fa-eye-slash');
                $('#password-1 i').addClass('fa-eye');
            }
        });
    }); 
</script>
@endpush