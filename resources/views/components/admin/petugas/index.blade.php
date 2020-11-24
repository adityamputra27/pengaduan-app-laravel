@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Data Petugas</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" data-toggle="modal" data-target="#formModal" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="users" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Role</th>
                            <th>No. Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $us)
                        <tr>
                            <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                            <td>{{ $us->nama_petugas }}</td>
                            <td>{{ $us->username }}</td>
                            <td><img width="50" src="{{ asset('assets/admin/uploads/' . $us->avatar) }}" alt=""></td>
                            <td>{{ $us->role }}</td>
                            <td>
                                <span class="badge badge-success">{{ $us->telp }}</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button id="showUpdate" data-mode="edit" data-toggle="modal" data-target="#formModal" type="button" data-id ="{{ $us->id }}" data-nama="{{ $us->username }}" data-role="{{ $us->role }}" data-petugas="{{ $us->nama_petugas }}" data-telp="{{ $us->telp }}" class="btn btn-warning btn-sm">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </button>
                                    @if($us->role == 'petugas')
                                        <button type="button" data-target="#confModal" data-toggle="modal" data-action="{{ route('petugas_delete', $us->id) }}" data-nama="{{ $us->nama_petugas }}" data-id="{{ $us->id }}" class="btn btn-danger btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm hapus-admin">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- {{-- MODAL TAMBAH --}} -->
<div class="modal fade" tabindex="-1" role="dialog" id="formModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Petugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formSimpan" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
                <label for="">Nama Petugas :</label>
                <input type="text" id="nama_petugas" class="form-control" name="nama_petugas">
                <span class="text-danger"><b id="nama-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Username :</label>
                <input type="text" id="username" class="form-control" name="username">
                <span class="text-danger"><b id="username-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Password :</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><b id="password-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password :</label>
                <input type="password" id="password_confirmation-error" class="form-control" name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="">No. Telp :</label>
                <input type="number" id="telp" class="form-control" name="telp">
            </div>
            <button type="submit" id="submitForm" class="btn btn-success btn-block"><i class="fa fa-check"></i> Simpan</button>
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- {{-- END MODAL TAMBAH --}} -->
<!-- Modal DELETE -->
<div class="modal fade" id="confModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Anda Yakin Ingin Menghapus <b id="namaHapus"></b>?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets') }}/admin/img/confirm-illustration.svg" class="img-fluid" alt="">
        <div class="alert alert-danger mt-3 mb-0" role="alert">
            <i class="fa fa-exclamation-triangle"></i>
            <b>Warning!</b> Data yang dihapus tidak akan kembali lagi!
        </div>
        <form id="formDelete" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="idHapus">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-check"></i> Hapus</button>
            <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL DELETE -->
@endsection
@push('javascript')
    <script>
    $(document).ready(function () {
        $('#users').DataTable({
            'search': true,
            'ordering': false,
            'iDisplayLength': 5
        });
    }); 

    $('#confModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget);
        let id = button.data('id');
        let nama = button.data('nama');
        let action = button.data('action');
        let modal = $(this);

        modal.find('.modal-body #formDelete').attr('action', action);
        modal.find('.modal-body #idHapus').val(id);
        modal.find('.modal-title #namaHapus').text(nama);
    });

    $('#formModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget);
        let id = button.data('id');
        let nama = button.data('nama');
        let petugas = button.data('petugas');
        let telp = button.data('telp');
        let role = button.data('role');
        let mode = button.data('mode');
        let modal = $(this);

        if (mode == 'edit') {
            modal.find('.modal-title').text('Ubah Data Petugas');
            modal.find('.modal-body #nama_petugas').val(petugas);
            modal.find('.modal-body #username').val(nama);
            modal.find('.modal-body #telp').val(telp);
            modal.find('.modal-body #method').html('{{ method_field("PATCH") }}<input type="hidden" name="id" value="'+id+'">');

            $('body').on('click', '#submitForm', function(e) {
                e.preventDefault();
                let form = $('#formSimpan');
                let formData = form.serialize();
                $('#nama-error').html('');
                $('#username-error').html('');
                $('#password-error').html('');
                $.ajax({
                    url: "{{ url('app/petugas') }}/" + id + "/update",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        console.log(data);
                        if (data.errors) {
                            if (data.errors.username) {
                                $('#username-error').html(data.errors.username[0]);
                                $('#username').addClass('is-invalid');
                            }
                            if (data.errors.nama_petugas) {
                                $('#nama-error').html(data.errors.nama_petugas[0]);
                                $('#nama_petugas').addClass('is-invalid');
                            }
                            if (data.errors.password) {
                                $('#password-error').html(data.errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                        }
                        if (data.success) {
                            window.location = "{{ route('petugas_home') }}";
                        }
                    }
                });
            });
        }
        else
        {
            modal.find('.modal-title').text('Tambah Data Petugas');
            modal.find('.modal-body #nama_petugas').val('');
            modal.find('.modal-body #username').val('');
            modal.find('.modal-body #telp').val('');
            modal.find('.modal-body #method').html('');

            $('body').on('click', '#submitForm', function(e) {
                e.preventDefault();
                let form = $('#formSimpan');
                let formData = form.serialize();
                $('#nama-error').html('');
                $('#username-error').html('');
                $('#password-error').html('');
                $.ajax({
                    url: "{{ route('petugas_simpan') }}",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        console.log(data);
                        if (data.errors) {
                            if (data.errors.nama_petugas) {
                                $('#nama-error').html(data.errors.nama_petugas[0]);
                                $('#nama_petugas').addClass('is-invalid');
                            }
                            if (data.errors.username) {
                                $('#username-error').html(data.errors.username[0]);
                                $('#username').addClass('is-invalid');
                            }
                            if (data.errors.password) {
                                $('#password-error').html(data.errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                        }
                        if (data.success) {
                            window.location = "{{ route('petugas_home') }}";
                        }
                    }
                });
            });
        }

    });

       // setTimeout(function() {
        //     $('#pesan-error').fadeTo(500, 0).slideUp(500, function(){
        //         $(this).remove(); 
        //     });
        // }, 2000);

        // $('#formSavePetugas').submit(function (event) {
        //     event.preventDefault();
        //     if($('#formSavePetugas').length > 0){
        //         $('#formSavePetugas').validate({

        //             rules:{
        //                 nama_petugas:{
        //                     required:true,
        //                     minlength:3
        //                 },
        //                 username:{
        //                     required:true,
        //                     minlength:3
        //                 },
        //                 password:{
        //                     required:true,
        //                     minlength:6
        //                 },
        //                 password_confirmation:{
        //                     required:true,
        //                     minlength:6,
        //                     equalTo:"#password"
        //                 }
        //             },

        //             messages:{
        //                 nama_petugas:{
        //                     required: "Nama Petugas Wajib Diisi!",
        //                     minlength: "Nama Petugas Minimal 3 Karakter!"
        //                 },
        //                 username:{
        //                     required: "Usename Wajib Diisi!",
        //                     minlength: "Username Minimal 3 Karakter!"
        //                 },
        //                 password:{
        //                     required: "Password Wajib Diisi!",
        //                     minlength: "Password Minimal 6 Karakter!"
        //                 },
        //                 password_confirmation:{
        //                     required: "Konfirmasi Password Wajib Diisi!",
        //                     minlength: "Konfirmasi Password Minimal 6 Karakter!",
        //                     equalTo: "Konfirmasi Password Tidak Sama Dengan Password!"
        //                 }
        //             },

        //             //submitHandler(form){
        //             //    $.ajaxSetup({
        //             //        headers:{
        //             //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
        //             //        }
        //             //    });
        //             //}

        //         });
        //     }
        //     let request = new FormData(this);
        //     $.ajax({
        //         url: "{{ route('petugas_simpan') }}",
        //         method: "POST",
        //         data: request,
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         success:function(data)
        //         {
        //             let warning = '<div class="alert alert-danger" id="pesan-error" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Username Sudah Ada!</div>';
        //             if(data == "sukses")
        //             {
        //                 window.location = "{{ route('petugas_home') }}";
        //                 //$('#ModalTambah').modal('toggle');
        //                 //$('#users').load();
        //             } 
        //             else if(data == "gagal") 
        //             {
        //                 $('#error').append(warning);
        //                 $('#formSavePetugas')[0].reset();
        //                 window.setTimeout(function() {
        //                     $("#pesan-error").fadeTo(500, 0).slideUp(500, function(){
        //                         $(this).remove();
        //                     });
        //                 }, 1500);
        //             }
        //         }
        //     });
        // });

    // $(document).on('click', '#showUpdate' , function () {
    //     let id = $(this).data('id')
    //     let nama_petugas = $(this).data('petugas');
    //     let nama = $(this).data('nama');
    //     let telp = $(this).data('telp');
    //     $('#modalEdit #id').val(id);
    //     $('#modalEdit #nama_petugas').val(nama_petugas);
    //     $('#modalEdit #username').val(nama);
    //     $('#modalEdit #telp').val(telp);
    // });

    // $('#formUpdatePetugas').submit(function (e) {
    //     e.preventDefault();
        
    //     if($('#formUpdatePetugas').length > 0 ){
    //         $('#formUpdatePetugas').validate({

    //             rules:{
    //                 nama_petugas:{
    //                     required:true,
    //                     minlength:3
    //                 },
    //                 username:{
    //                     required:true,
    //                     minlength:3
    //                 },
    //                 password:{
    //                     required:true,
    //                     minlength:6
    //                 },
    //                 password_confirmation:{
    //                     required:true,
    //                     minlength:6,
    //                     equalTo:"#password"
    //                 }
    //             },

    //             messages:{
    //                 nama_petugas:{
    //                     required: "Nama Petugas Wajib Diisi!",
    //                     minlength: "Nama Petugas Minimal 3 Karakter!"
    //                 },
    //                 username:{
    //                     required: "Usename Wajib Diisi!",
    //                     minlength: "Username Minimal 3 Karakter!"
    //                 },
    //                 password:{
    //                     required: "Password Wajib Diisi!",
    //                     minlength: "Password Minimal 6 Karakter!"
    //                 },
    //                 password_confirmation:{
    //                     required: "Konfirmasi Password Wajib Diisi!",
    //                     minlength: "Konfirmasi Password Minimal 6 Karakter!",
    //                     equalTo: "Konfirmasi Password Tidak Sama Dengan Password!"
    //                 }
    //             },

    //             //submitHandler(form){
    //             //    $.ajaxSetup({
    //             //        headers:{
    //             //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
    //             //        }
    //             //    });
    //             //}

    //         });
    //     }
    //     let id = $('#id').val();
    //     let request = new FormData(this);
    //     $.ajax({
    //         url: "{{ url('app/petugas') }}/" + id + "/update",
    //         method: "POST",
    //         data: request,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success:function(data)
    //         {
    //             window.location = "{{ route('petugas_home') }}";
    //         }
    //     });
    // });

    //$('#formSavePetugas').validate();

    //$('#formSavePetugas').submit(function (e) {
    //    e.preventDefault();
        // let nama_petugas = $('input[name=nama_petugas]').val();
        // let username = $('input[nama=username]').val();
        // let password = $('input[name=password]').val();
        // let telp = $('input[name=telp]').val();
        // let _token = $('input[name=_token]').val();

        // $.ajax({
        //     url: "{{ route('petugas_simpan') }}",
        //     type: "POST",
        //     data: {
        //           nama_petugas:nama_petugas,
        //           username:username,
        //           password:password,
        //           telp:telp,
        //           _token:_token
        //     },
        //     success:function(response)
        //     {
        //         window.location = "{{ route('petugas_home') }}";
        //     }
        // });
        
    //});

    // $('.delete-confirm').click(function (e) {
    //     //e.preventDefault();
    //     let nama = $(this).data('nama');
    //     let id = $(this).data('id');
    //     Swal.fire({
    //         title: 'Apakah Kamu Yakin Akan Menghapus '+ id +' ' + nama + '?',
    //         showDenyButton: true,
    //         confirmButtonText: 'Hapus',
    //         denyButtonText: 'Batal',
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             $('#formDeletePetugas').submit();
    //         } else if (result.isDenied) {
    //             Swal.fire('Petugas '+nama+' Tidak Jadi Di Hapus!', '', 'info');
    //         }
    //     })
    // });

    $(document).on('click', '.hapus-admin', function(){
        Swal.fire({
            icon: 'error',
            title: 'Akun Administrator Tidak Bisa Di Hapus!',
            showConfirmButton: false,
            timer: 3000
        });
    });

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