@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Data Kategori Aduan</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" data-mode="tambah" data-toggle="modal" data-target="#formModal" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="kategori" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $kategori => $kat)
                        <tr>
                            <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                            <td>{{ $kat->nama_kategori }}</td>
                            <td>
                                <div class="btn-group">
                                    <button id="showUpdate" data-mode="edit" data-toggle="modal" data-target="#formModal" type="button" data-id="{{ $kat->id_kategori }}" data-nama="{{ $kat->nama_kategori }}" class="btn btn-warning btn-sm">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </button>
                                    <button data-target="#confModal" data-toggle="modal" type="button" data-id="{{ $kat->id_kategori }}" data-action="{{ route('kategori.delete', $kat->id_kategori) }}" data-nama="{{ $kat->nama_kategori }}" class="btn btn-danger btn-sm">
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
<!-- {{-- Modal DELETE --}} -->
<div class="modal fade" tabindex="-1" role="dialog" id="confModal">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Yakin Hapus Kategori <b id="kategori"></b>?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets') }}/admin/img/reject-illustration.svg" width="300" class="img-fluid mb-3" alt="">
        <form id="formDelete" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" id="idHapus" name="id_kategori">
            <button type="submit" id="submitForm" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> Hapus</button>
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- {{-- End Modal DELETE --}} -->
<!-- {{-- Modal Tambah --}} -->
<div class="modal fade" tabindex="-1" role="dialog" id="formModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori Aduan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formSave" method="POST">
        @csrf
        <div id="method"></div>
            <div class="form-group">
                <label for="">Nama Kategori :</label>
                <input type="text" id="nama_kategori" class="form-control" name="nama_kategori">
                <span class="text-danger"><b id="nama-error"></b></span>
            </div>
            <button type="submit" id="submitForm" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> Simpan</button>
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- {{-- End Modal TAMBAH --}} -->
@endsection
@push('javascript')
<script>
    $(document).ready(function () {
        $('#kategori').DataTable({
            'search': true,
            'ordering': false,
            'iDisplayLength': 5
        });
    });

    $('#confModal').on('show.bs.modal', function(e){
        let button = $(e.relatedTarget);
        let id = button.data('id');
        let nama = button.data('nama');
        let action = button.data('action');
        let modal = $(this);

        modal.find('.modal-body #formDelete').attr('action', action);
        modal.find('.modal-body #idHapus').val(id);
        modal.find('.modal-title #kategori').html(nama);
    });

    $('#formModal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var mode = button.data('mode');
        var nama = button.data('nama');
        var modal = $(this);
        
        if (mode == 'edit') {
            modal.find('.modal-title').text('Ubah Kategori Aduan');
            modal.find('.modal-body #nama_kategori').val(nama);
            modal.find('.modal-body #method').html('{{ method_field("PATCH") }}<input type="hidden" name="id_kategori" value="'+id+'">');

            $('body').on('click', '#submitForm', function(e) {
                e.preventDefault();
                var form = $('#formSave');
                var formData = form.serialize();
                $('#nama-error').html('');
                $.ajax({
                    url: "{{ url('app/kategori') }}/" + id + "/update",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        console.log(data);
                        if (data.errors) {
                            if (data.errors.nama_kategori) {
                                $('#nama-error').html(data.errors.nama_kategori[0]);
                                $('#nama_kategori').addClass('is-invalid');
                            }
                        }
                        if (data.success) {
                            window.location = "{{ route('kategori') }}";
                        }
                    }
                });
            });
        }
        else
        {
            modal.find('.modal-title').text('Tambah Kategori Aduan');
            modal.find('.modal-body #nama_kategori').val('');
            modal.find('.modal-body #method').html('');

            $('body').on('click', '#submitForm', function(e) {
                e.preventDefault();
                var form = $('#formSave');
                var formData = form.serialize();
                $('#nama-error').html('');
                $.ajax({
                    url: "{{ route('kategori.simpan') }}",
                    method: "POST",
                    data: formData,
                    success:function(data){
                        console.log(data);
                        if (data.errors) {
                            if (data.errors.nama_kategori) {
                                $('#nama-error').html(data.errors.nama_kategori[0]);
                                $('#nama_kategori').addClass('is-invalid');
                                // setTimeout(function () {
                                //     $('#nama-error').fadeTo(300, 0).slideUp(300, function(){
                                //         $('#nama-error').html('');
                                //     });
                                //     $('#nama_kategori').removeClass('is-invalid');
                                // }, 3000);
                            }
                        }
                        if (data.success) {
                            window.location = "{{ route('kategori') }}";
                        }
                    }
                });
            });
        }
    });
    // $('.swal-confirm').click(function () {
    //     var nama = $(this).data('nama');
    //     Swal.fire({
    //         title: 'Apakah Kamu Yakin Akan Menghapus Kategori ' + nama + '?',
    //         showDenyButton: true,
    //         confirmButtonText: 'Hapus',
    //         denyButtonText: 'Batal',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $('#formDelete').submit();
    //         } else if (result.isDenied) {
    //             Swal.fire('Nama Kategori '+ nama +' Tidak Di Hapus!', '', 'info');
    //         }
    //     })
    // });

    // $(document).on('click', '#showUpdate', function() {
    //     //e.preventDefault();
    //     var nama_kategori = $(this).data('nama');
    //     var id = $(this).data('id')
    //     $('#modalEdit #id_kategori').val(id);
    //     $('#modalEdit #nama_kategori').val(nama_kategori);
    // });

    // $('#formUpdate').submit(function (e) {
    //     e.preventDefault();
    //     var id = $('#id_kategori').val();
    //     var request = new FormData(this);
    //     $.ajax({
    //         url: "{{ url('app/kategori-aduan') }}/" + id + "/update",
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
    //                 window.location = "{{ route('kategori') }}";
    //             }
    //             else if(data == "gagal")
    //             {
    //                 var warning = '<div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Gagal Update Data!</div>';
    //                 $('#error').append(warning);
    //             }
    //         }
    //     });
    // });


    // $('#formSave').submit(function (e) {
    //     e.preventDefault();
    //     var request = new FormData(this);
    //     $.ajax({
    //         url: "{{ route('kategori.simpan') }}",
    //         method: "POST",
    //         data: request,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success:function(data)
    //         {
    //             var warning = '<div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Nama Kategori Sudah Ada!</div>';
    //             if(data == "sukses")
    //             {
    //                 window.location = "{{ route('kategori') }}";
    //             } else if(data == "gagal") {
    //                 $('#error').append(warning);
    //                 $('#formSave')[0].reset();
    //             }
    //         }
    //     });
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