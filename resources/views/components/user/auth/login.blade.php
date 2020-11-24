@extends('components.user.layout.header')
@section('section-hero')
<div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
    <div>
    <h1>Login</h1>
    </div>
</div>
<div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
    <img src="{{ asset('assets') }}/img/login-user.svg" class="img-fluid" alt="">
</div>
@endsection
@section('content-user')
<section id="login">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-success">Silahkan Login.</h4>
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
                        <form action="{{ route('login_account') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="text-success" for="">Username</label>
                                <input type="text" name="username" class="form-control">
                                <span class="text-danger">@error('username'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-success">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button"><span class="fa fa-eye"></span></button>
                                    </div>
                                </div>
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><span class="bx bx-send"></span> Login</button>
                            </div>
                            <div class="form-group">
                                <p>Belum Punya Akun? Register <a href="{{ route('user.register') }}">Disini!</a></p>
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
    $(document).ready(function () {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 3500);
    });
</script>
@endpush