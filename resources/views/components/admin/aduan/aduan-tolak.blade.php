@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Data Aduan Yang Di Tolak</h1>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tampil as $item)
                            <tr>
                                <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                                <td><span class="badge badge-primary">{{ $item->id_pengaduan }}</span></td>
                                <td>{{ $item->masyarakat->nama_lengkap }}</td>
                                <td>{{ date('d M Y', strtotime($item->tgl_pengaduan)) }}</td>
                                <td>
                                    <span class="badge badge-danger">Ditolak!</span>
                                    <!-- @if($item->status == '0')
                                        <span class="badge badge-warning">Belum Di Verifikasi</span>
                                    @elseif($item->status == 'proses')
                                        <span class="badge badge-info">Sedang Di Proses</span>
                                    @elseif($item->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak!</span>
                                    @endif -->
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if(Auth::guard('petugas')->user()->role == 'admin')
                                            <a href="#" data-mode="restore" data-toggle="modal" data-target="#confModal" data-verify="{{ route('restore_aduan', $item->id) }}" data-imgverify="{{ asset('assets') }}/admin/img/verified_illustrator.svg" class="btn btn-icon-split btn-sm btn-success">
                                                <span class="icon text-white-100">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Restore</span>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#confModal" data-reject="{{ route('delete_aduan', $item->id) }}" data-imgreject="{{ asset('assets') }}/admin/img/reject-illustration.svg" class="btn btn-icon-split btn-sm btn-danger">
                                            <span class="icon text-white-100">
                                            <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                        @endif
                                        <a href="#" data-no="{{ $item->id_pengaduan }}" data-nik="{{ $item->nik }}" data-pelapor="{{ $item->masyarakat->nama_lengkap }}" data-tanggal="{{ date('d-m-Y', strtotime($item->tgl_pengaduan)) }}" data-foto="{{ asset('assets/uploads/'.$item->foto) }}"
                                        data-status="{{ $item->status }}" data-laporan="{!! $item->isi_laporan !!}"
                                        data-toggle="modal" data-target="#detModal" data-title="Detail Aduan No. : <b>{{ $item->id_pengaduan }}</b>"
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
                        <th>Bukti Foto</th>
                        <td>:</td>
                        <td><img width="100" id="foto"></td>
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
        let foto = button.data('foto');
        let modal = $(this);

        modal.find('.modal-title').html(title);
        modal.find('.modal-body #no').text(no);
        modal.find('.modal-body #nik').text(nik);
        modal.find('.modal-body #pelapor').text(pelapor);
        modal.find('.modal-body #tanggal').text(tanggal);
        modal.find('.modal-body #laporan').html(laporan);
        modal.find('.modal-body #foto').attr('src',foto);
    });

    $('#confModal').on('show.bs.modal', function (e) {
        let button = $(e.relatedTarget);
        let verify = button.data('verify');
        let imgverify = button.data('imgverify');
        let reject = button.data('reject');
        let imgreject = button.data('imgreject');
        let mode = button.data('mode');
        let modal = $(this);

        if (mode == 'restore') {
            modal.find('.modal-title #title').text('Yakin Restore Aduan?');
            modal.find('.modal-body #img-info').attr('src', imgverify);
            modal.find('.modal-footer #btn-show').html('<i class="fa fa-check-circle"></i> Restore!');
            modal.find('.modal-footer #btn-show').addClass('btn-success');
            modal.find('.modal-footer #btn-show').removeClass('btn-danger');
            modal.find('.modal-body #formSelect').attr('action', verify);
        }
        else
        {
            modal.find('.modal-title #title').text('Yakin Hapus Aduan?');
            modal.find('.modal-body #method').html('{{ method_field("DELETE") }}');
            modal.find('.modal-body #img-info').attr('src', imgreject);
            modal.find('.modal-footer #btn-show').html('<i class="fa fa-check-circle"></i> Hapus Permanen!');
            modal.find('.modal-footer #btn-show').addClass('btn-danger');
            modal.find('.modal-footer #btn-show').removeClass('btn-primary');
            modal.find('.modal-body #formSelect').attr('action', reject);
        }
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