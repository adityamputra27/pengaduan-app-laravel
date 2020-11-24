@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Data Masyarakat</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" data-toggle="modal" data-target="#formModal" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="masyarakat" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Foto Profile</th>
                            <th>Username</th>
                            <th>No. Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($msy as $m)
                        <tr>
                            <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                            <td>{{ $m->nama_lengkap }}</td>
                            <td>{{ $m->nik }}</td>
                            <td>
                                <img src="{{ asset('assets/uploads/'.$m->avatar) }}" width="50" alt="">
                            </td>
                            <td>{{ $m->username }}</td>
                            <td>{{ $m->telp }}</td>
                            <td>
                                <div class="btn-group">
                                    <button id="showUpdate" data-toggle="modal" data-target="#formModal" type="button" data-id="{{ $m->id }}" data-mode="edit"
                                    data-nik="{{ $m->nik }}" data-nama="{{ $m->nama_lengkap }}" data-username="{{ $m->username }}" data-telp="{{ $m->telp }}" class="btn btn-warning btn-sm">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </button>
                                    <button type="button" data-nama="{{ $m->nama_lengkap }}" data-id="{{ $m->id }}" data-action="{{ route('hapus_masyarakat', $m->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confModal">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </button>
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
<!-- {{-- Modal Form --}} -->
<div class="modal fade" tabindex="-1" role="dialog" id="formModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah User / Masyarakat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formSimpan" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
                <label for="">NIK :</label>
                <input type="number" id="nik" class="form-control" name="nik">
                <span class="text-danger"><b id="nik-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Nama Lengkap :</label>
                <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap">
                <span class="text-danger"><b id="nama-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Username :</label>
                <input type="text" id="username" class="form-control" name="username">
                <span class="text-danger"><b id="username-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Password :</label>
                <input type="password" id="password" class="form-control" name="password">
                <span class="text-danger"><b id="password-error"></b></span>
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password :</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="">No Telepon :</label>
                <input type="number" id="telp" class="form-control" name="telp">
                <span class="text-danger"><b id="telp-error"></b></span>
            </div>
            <button type="submit" id="submitForm" class="btn btn-success btn-block"><i class="fa fa-check"></i> Simpan</button>
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- {{-- End Modal FORM --}} -->
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
        $('#masyarakat').DataTable({
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
    })

    $('#formModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget);
        let id = button.data('id');
        let nik = button.data('nik');
        let nama = button.data('nama');
        let username = button.data('username');
        let telp = button.data('telp');
        let mode = button.data('mode');
        let modal = $(this);

        if (mode == 'edit') {
            modal.find('.modal-title').text('Ubah Data User / Masyarakat');
            modal.find('.modal-body #nik').val(nik);
            modal.find('.modal-body #nama_lengkap').val(nama);
            modal.find('.modal-body #username').val(username);
            modal.find('.modal-body #telp').val(telp);
            modal.find('.modal-body #method').html('{{ method_field("PATCH") }}<input type="hidden" name="id" value="'+id+'">');

            $('body').on('click', '#submitForm', function(e) {
                e.preventDefault();
                let form = $('#formSimpan');
                let formData = form.serialize();
                $('#nik-error').html('');
                $('#nama-error').html('');
                $('#username-error').html('');
                $('#password-error').html('');
                $('#telp-error').html('');
                $.ajax({
                    url: "{{ url('app/data-masyarakat') }}/" + id + "/update",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        console.log(data);
                        if (data.errors) {
                            if (data.errors.nik) {
                                $('#nik-error').html(data.errors.nik[0]);
                                $('#nik').addClass('is-invalid');
                            }
                            if (data.errors.nama_lengkap) {
                                $('#nama-error').html(data.errors.nama_lengkap[0]);
                                $('#nama_lengkap').addClass('is-invalid');
                            }
                            if (data.errors.username) {
                                $('#username-error').html(data.errors.username[0]);
                                $('#username').addClass('is-invalid');
                            }
                            if (data.errors.password) {
                                $('#password-error').html(data.errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                            if (data.errors.telp) {
                                $('#telp-error').html(data.errors.telp[0]);
                                $('#telp').addClass('is-invalid');
                            }
                        }
                        setTimeout(function () {
                            $('#nik-error,#nama-error,#username-error,#password-error,#telp-error').html('');
                            $('#nik,#nama_lengkap,#username,#password,#telp').removeClass('is-invalid');
                        }, 3000);
                        if (data.success) {
                            window.location = "{{ route('kelola_masyarakat') }}";
                        }
                    }
                });
            });
        }
        else
        {
            modal.find('.modal-title').text('Tambah Data User / Masyarakat');
            modal.find('.modal-body #nik').val('');
            modal.find('.modal-body #nama_lengkap').val('');
            modal.find('.modal-body #username').val('');
            modal.find('.modal-body #telp').val('');
            modal.find('.modal-body #method').html('');

            $('body').on('click', '#submitForm', function(e) {
                e.preventDefault();
                let form = $('#formSimpan');
                let formData = form.serialize();
                $('#nik-error').html('');
                $('#nama-error').html('');
                $('#username-error').html('');
                $('#password-error').html('');
                $('#telp-error').html('');
                $.ajax({
                    url: "{{ route('simpan_masyarakat') }}",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        console.log(data);
                        if (data.errors) {
                            if (data.errors.nik) {
                                $('#nik-error').html(data.errors.nik[0]);
                                $('#nik').addClass('is-invalid');
                            }
                            if (data.errors.nama_lengkap) {
                                $('#nama-error').html(data.errors.nama_lengkap[0]);
                                $('#nama_lengkap').addClass('is-invalid');
                            }
                            if (data.errors.username) {
                                $('#username-error').html(data.errors.username[0]);
                                $('#username').addClass('is-invalid');
                            }
                            if (data.errors.password) {
                                $('#password-error').html(data.errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                            if (data.errors.telp) {
                                $('#telp-error').html(data.errors.telp[0]);
                                $('#telp').addClass('is-invalid');
                            }
                            setTimeout(function () {
                                $('#nik-error,#nama-error,#username-error,#password-error,#telp-error').html('');
                                $('#nik,#nama_lengkap,#username,#password,#telp').removeClass('is-invalid');
                            }, 3000);
                            // if (data.errors.nama_kategori) {
                            //     $('#nama-error').html(data.errors.nama_kategori[0]);
                            //     $('#nama_kategori').addClass('is-invalid');
                            //     // setTimeout(function () {
                            //     //     $('#nama-error').fadeTo(300, 0).slideUp(300, function(){
                            //     //         $('#nama-error').html('');
                            //     //     });
                            //     //     $('#nama_kategori').removeClass('is-invalid');
                            //     // }, 3000);
                            // }
                        }
                        if (data.success) {
                            window.location = "{{ route('kelola_masyarakat') }}";
                        }
                    }
                });
            });
        }

    });

    // $(document).on('click', '#showUpdate', function() {
    //     //e.preventDefault();
    //     let id = $(this).data('id')
    //     let nik = $(this).data('nik');
    //     let nama_lengkap = $(this).data('nama');
    //     let username = $(this).data('username');
    //     let telp = $(this).data('telp');
    //     $('#modalEditMasyarakat #id').val(id);
    //     $('#modalEditMasyarakat #nik').val(nik);
    //     $('#modalEditMasyarakat #nama_lengkap').val(nama_lengkap);
    //     $('#modalEditMasyarakat #username').val(username);
    //     $('#modalEditMasyarakat #telp').val(telp);
    // });

    // $('#formUpdate').submit(function (e) {
    //     e.preventDefault();
    //     let id = $('#id').val();
    //     let request = new FormData(this);
    //     $.ajax({
    //         url: "{{ url('app/data-masyarakat') }}/" + id + "/update",
    //         method: "POST",
    //         data: request,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success:function(data)
    //         {
    //             $('#formUpdate')[0].reset();
    //             if(data == "sukses")
    //             {
    //                 //Swal.fire({
    //                 //    icon: 'success',
    //                 //    title: 'Kategori Berhasil Di Update!',
    //                 //    showConfirmButton: false,
    //                 //    timer: 3000
    //                 //});
    //                 //$('#modalEdit').modal('hide');
    //                 //$('#kategori').load();
    //                 window.location = "{{ route('kelola_masyarakat') }}";
    //             }
    //             else if(data == "gagal")
    //             {
    //                 let warning = '<div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Gagal Update Data!</div>';
    //                 $('#error').append(warning);
    //             }
    //         }
    //     });
    // });

    // $('#formSaveMasyarakat').submit(function (e) {
    //     e.preventDefault();
    //     let request = new FormData(this);
    //     $.ajax({
    //         url: "{{ route('simpan_masyarakat') }}",
    //         method: "POST",
    //         data: request,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success:function(data)
    //         {
    //             let warning = '<div class="alert alert-danger" id="pesan-error" role="alert"><i class="fa fa-info-circle"></i> Data NIK Sudah Ada!</div>';
    //             if(data == "sukses")
    //             {
    //                 window.location = "{{ route('kelola_masyarakat') }}";
    //             }
    //             else if(data == "gagal") 
    //             {
    //                 $('#error').append(warning);
    //                 $('#formSaveMasyarakat')[0].reset();
    //                 window.setTimeout(function() {
    //                     $("#pesan-error").fadeTo(500, 0).slideUp(500, function(){
    //                         $(this).remove();
    //                     });
    //                 }, 1500);
    //             }
    //         }
    //     });
    // });

    // $('.swal-confirm').click(function (e) {
    //     //e.preventDefault();
    //     let nama = $(this).data('nama');
    //     let id = e.target.dataset.id;
    //     Swal.fire({
    //         title: 'Apakah Kamu Yakin Akan Menghapus User ' + nama + '?',
    //         showDenyButton: true,
    //         confirmButtonText: 'Hapus',
    //         denyButtonText: 'Batal',
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             $('#formDeleteMasyarakat').submit();
                
    //         } else if (result.isDenied) {
    //             Swal.fire('User / Masyarakat Tidak Di Hapus!', '', 'info');
    //         }
    //     })
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
</script>
@endpush