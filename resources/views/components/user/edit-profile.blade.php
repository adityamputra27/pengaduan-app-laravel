@extends('components.user.layout.header')
@section('section-hero')
<div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
    <div>
    <h1>Edit Profile</h1>
    </div>
</div>
<div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
    <img src="{{ asset('assets') }}/img/edit-illustration.svg" class="img-fluid" alt="">
</div>
@endsection
@section('content-user')
<section id="login">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('user_dashboard') }}" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
                <div class="card mt-3">
                    <div class="card-body">
                      <form id="updateForm" action="{{ route('auth_update', $result->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="col-sm-6">NIK :</label>
                              <div class="col-sm-12">
                                <input type="text" name="nik" class="form-control"
                                value="{{ @$result->nik }}"/>
                                @error('nik') <span class="text-danger">{{ $message }}</span>@enderror
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-6">Nama Lengkap :</label>
                              <div class="col-sm-12">
                                <input type="text" name="nama_lengkap" class="form-control"
                                value="{{ @$result->nama_lengkap }}"/>
                                @error('nama_lengkap') <span class="text-danger">{{ $message }}</span>@enderror
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-6">Username :</label>
                              <div class="col-sm-12">
                                <input type="text" name="username" class="form-control"
                                value="{{ @$result->username }}"/>
                                @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-6">No Telepon :</label>
                              <div class="col-sm-12">
                                <input type="text" name="telp" class="form-control"
                                value="{{ @$result->telp }}"/>
                                @error('telp') <span class="text-danger">{{ $message }}</span>@enderror
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group has-feedback">
                              <label class="col-sm-6">Password Baru :</label>
                              <div class="col-sm-12">
                                <input type="password" name="password" class="form-control"
                                value=""/>
                                @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                              </div>
                            </div>
                            <div class="form-group has-feedback">
                              <label class="col-sm-6">Konfirmasi Password Baru :</label>
                              <div class="col-sm-12">
                                <input type="password" id="pass" name="password_confirmation" class="form-control"
                                value=""/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-6">Avatar :</label>
                              <div class="col-sm-12">
                                <img src="{{ asset('assets/uploads/'.$result->avatar) }}" width="215" class="" alt="Profile Image">
                                <input type="file" name="avatar" class="uploads form-control"
                                value=""/>
                                @error('avatar') <span class="text-danger">{{ $message }}</span>@enderror
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button type="submit" id="updateProfile" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Edit Profile</button>
                          </div>
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
<li class=""><a href="#"><i class="fa fa-user"></i> Selamat Datang, {{ Auth::guard('masyarakat')->user()->nama_lengkap }}</a></li>
<li class=""><a href="#" data-toggle="modal" data-target="#confLogout"><i class="fa fa-sign-out"></i> Logout</a></li>
@endsection
@push('javascript')
    <script>
        // $('.table-aduan-user').DataTable({
        //     'ordering': false,
        //     'search': true,
        //     'iDisplayLength': 3
        // });
        @if ($message = Session::get('save'))
        Swal.fire({
          icon: 'success',
          title: '{{ $message }}',
          showConfirmButton: false,
          timer: 3000
        });
        @endif
        @if ($message = Session::get('error'))
        Swal.fire({
          icon: 'error',
          title: '{{ $message }}',
          showConfirmButton: false,
          timer: 3000
        });
        @endif
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                return false
            })
        })
    </script>
@endpush