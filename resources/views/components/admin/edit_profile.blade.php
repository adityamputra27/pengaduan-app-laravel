@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
          <form id="updateForm" action="{{ route('update_profile', $result->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-6">Nama Lengkap :</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama_petugas" class="form-control"
                    value="{{ @$result->nama_petugas }}"/>
                    @error('nama_petugas') <span class="text-danger">{{ $message }}</span>@enderror
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
              </div>

              <div class="col-md-6" style="margin-top: 6px;">
                <div class="form-group">
                  <label class="col-sm-6">Avatar :</label>
                  <div class="col-sm-12">
                    <img src="{{ asset('assets/admin/uploads/'.$result->avatar) }}" width="215" class="" alt="Profile Image">
                    <input type="file" name="avatar" class="uploads form-control"
                    value=""/>
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
@endsection
@push('javascript')
    <script>
        $('body').on('click', '#updateProfile', function(e) {
            // e.preventDefault();
        });

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
    </script>
@endpush
