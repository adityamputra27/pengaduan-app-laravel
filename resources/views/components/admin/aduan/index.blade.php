@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Data Aduan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data-aduan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Aduan</th>
                            <th>Nama Pelapor</th>
                            <th>Tanggal</th>
                            <th>Bukti Foto (Gambar)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduan as $p)
                            <tr>
                                <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                                <td><span class="badge badge-primary">{{ $p->id_pengaduan }}</span></td>
                                <td>{{ $p->masyarakat->nama_lengkap }}</td>
                                <td>{{ date('d M Y', strtotime($p->tgl_pengaduan)) }}</td>
                                <td>
                                    @foreach(json_decode($p->foto) as $foto)
                                        <img src="{{ asset('assets/uploads/'.$foto) }}" width="50" alt="">
                                    @endforeach
                                </td>
                                <td>
                                    @if($p->status == '0')
                                        <span class="badge badge-warning">Belum Di Verifikasi</span>
                                    @elseif($p->status == 'proses')
                                        <span class="badge badge-info">Sedang Di Proses</span>
                                    @elseif($p->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak!</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($p->status == '0')
                                            @if(Auth::guard('petugas')->user()->role == 'admin')
                                                <a href="#" data-mode="verifikasi" data-toggle="modal" data-target="#confModal" data-verify="{{ route('verifikasi_aduan', $p->id) }}" data-imgverify="{{ asset('assets') }}/admin/img/verified_illustrator.svg" class="btn btn-icon-split btn-sm btn-success">
                                                    <span class="icon text-white-100">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="text">Verifikasi</span>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#confModal" data-reject="{{ route('tolak_aduan', $p->id) }}" data-imgreject="{{ asset('assets') }}/admin/img/reject-illustration.svg" class="btn btn-icon-split btn-sm btn-danger">
                                                <span class="icon text-white-100">
                                                <i class="fas fa-exclamation"></i>
                                                </span>
                                                <span class="text">Tolak</span>
                                            </a>
                                            @endif
                                        @endif
                                        <a href="#" data-no="{{ $p->id_pengaduan }}" data-nik="{{ $p->nik }}" data-pelapor="{{ $p->masyarakat->nama_lengkap }}" data-tanggal="{{ date('d-m-Y', strtotime($p->tgl_pengaduan)) }}"
                                        data-status="{{ $p->status }}" data-laporan="{!! $p->isi_laporan !!}"
                                        data-toggle="modal" data-target="#detModal" data-title="Detail Aduan No. : <b>{{ $p->id_pengaduan }}</b>"
                                        class="btn btn-icon-split btn-sm btn-info">
                                            <span class="icon text-white-100">
                                            <i class="fas fa-eye"></i>
                                            </span>
                                            <span class="text">Lihat</span>
                                        </a>
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
<!-- Modal VERIFY -->
<div class="modal fade" id="confModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="title"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="img-info" class="img-fluid" width="300" alt="">
        <form id="formSelect" method="POST">
            @csrf
            <div id="method"></div>
            <input type="hidden" name="id_pengaduan" id="idHapus">
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn-show" class="btn btn-block"></button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL VERIFY -->
<!-- MODAL DETAIL -->
<div class="modal fade" id="detModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No. Aduan</th>
                        <td>:</td>
                        <td><span id="no"></span></td>
                    </tr>
                    <tr>
                        <th>NIK Pelapor</th>
                        <td>:</td>
                        <td><span id="nik"></span></td>
                    </tr>
                    <tr>
                        <th>Nama Pelapor</th>
                        <td>:</td>
                        <td><span id="pelapor"></span></td>
                    </tr>
                    <tr>
                        <th>Tanggal Aduan</th>
                        <td>:</td>
                        <td><span id="tanggal"></span></td>
                    </tr>
                    <tr>
                        <th>Isi Laporan</th>
                        <td>:</td>
                        <td><span id="laporan"></span></td>
                    </tr>
                    <tr>
                        <th>Status Aduan</th>
                        <td>:</td>
                        <td><span id="status"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL DETAIL -->
@endsection
@push('javascript')
<script>
    $(document).ready(function () {
        $('#data-aduan').DataTable({
            'search': true,
            'ordering': false,
            'iDisplayLength': 5
        });
    });

    // function htmlspecialchars(str){
    //     return str.replace('&', '&amp;').replace('"', '&quot;').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
    // }

    $('#detModal').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget);
        let title = button.data('title');
        let no = button.data('no');
        let nik = button.data('nik');
        let pelapor = button.data('pelapor');
        let tanggal = button.data('tanggal');
        let laporan = button.data('laporan');
        // let foto = JSON.parse(button.data('foto'));
        let status = button.data('status');
        let modal = $(this);

        modal.find('.modal-title').html(title);
        modal.find('.modal-body #no').text(no);
        modal.find('.modal-body #nik').text(nik);
        modal.find('.modal-body #pelapor').text(pelapor);
        modal.find('.modal-body #tanggal').text(tanggal);
        modal.find('.modal-body #laporan').html(laporan);
        // $.each(foto, function(){
        //     modal.find('.modal-body #foto').attr('src','{{ asset("assets/uploads/") }}'+foto);
        // });
        // modal.find('.modal-body #status').addClass('badge badge-secondary');
        if (status == '0' && status != 'proses' && status != 'selesai') {
            modal.find('.modal-body #status').html('<span class="badge badge-warning">Belum Di Verifikasi</span>');
        }
        else if(status == 'proses' && status != '0' && status != 'selesai')
        {
            modal.find('.modal-body #status').html('<span class="badge badge-primary">Sedang Di Proses</span>');
        }
        else if(status == 'selesai' && status != 'proses' && status != '0')
        {
            modal.find('.modal-body #status').html('<span class="badge badge-success">Selesai</span>');
        }
    });

    $('#confModal').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget);
        let verify = button.data('verify');
        let imgverify = button.data('imgverify');
        let reject = button.data('reject');
        let imgreject = button.data('imgreject');
        let mode = button.data('mode');
        let modal = $(this);

        if (mode == 'verifikasi') {
            modal.find('.modal-title #title').text('Yakin Verifikasi Aduan?');
            modal.find('.modal-body #img-info').attr('src', imgverify);
            modal.find('.modal-footer #btn-show').html('<i class="fa fa-check-circle"></i> Verifikasi!');
            modal.find('.modal-footer #btn-show').addClass('btn-primary');
            modal.find('.modal-footer #btn-show').removeClass('btn-danger');
            modal.find('.modal-body #formSelect').attr('action', verify);
        }
        else
        {
            modal.find('.modal-title #title').text('Yakin Tolak Aduan?');
            modal.find('.modal-body #method').html('{{ method_field("DELETE") }}');
            modal.find('.modal-body #img-info').attr('src', imgreject);
            modal.find('.modal-footer #btn-show').html('<i class="fa fa-check-circle"></i> Tolak!');
            modal.find('.modal-footer #btn-show').addClass('btn-danger');
            modal.find('.modal-footer #btn-show').removeClass('btn-primary');
            modal.find('.modal-body #formSelect').attr('action', reject);
        }
    });

    // $(document).on('click', '#showUpdate', function() {
    //     //e.preventDefault();
    //     var id = $(this).data('id')
    //     var nik = $(this).data('nik');
    //     var nama_lengkap = $(this).data('nama');
    //     var username = $(this).data('username');
    //     var telp = $(this).data('telp');
    //     $('#modalEditMasyarakat #id').val(id);
    //     $('#modalEditMasyarakat #nik').val(nik);
    //     $('#modalEditMasyarakat #nama_lengkap').val(nama_lengkap);
    //     $('#modalEditMasyarakat #username').val(username);
    //     $('#modalEditMasyarakat #telp').val(telp);
    // });

    // $('#formUpdate').submit(function (e) {
    //     e.preventDefault();
    //     var id = $('#id').val();
    //     var request = new FormData(this);
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
    //                 var warning = '<div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> Gagal Update Data!</div>';
    //                 $('#error').append(warning);
    //             }
    //         }
    //     });
    // });

    // $('#formSaveMasyarakat').submit(function (e) {
    //     e.preventDefault();
    //     var request = new FormData(this);
    //     $.ajax({
    //         url: "{{ route('simpan_masyarakat') }}",
    //         method: "POST",
    //         data: request,
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success:function(data)
    //         {
    //             var warning = '<div class="alert alert-danger" id="pesan-error" role="alert"><i class="fa fa-info-circle"></i> Data NIK Sudah Ada!</div>';
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
    //     var nama = $(this).data('nama');
    //     var id = e.target.dataset.id;
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