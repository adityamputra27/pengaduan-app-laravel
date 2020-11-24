@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Data Tanggapan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tanggapan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Isi Aduan (Laporan)</th>
                            <th>Tanggal</th>
                            <th>Tanggapan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $res)
                            <tr>
                                <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                                <td>{!! Str::substr($res->isi_laporan, 0, 50) !!}</td>
                                <td>{{ date('d M Y', strtotime($res->tgl_pengaduan)) }}</td>
                                <td align="center">
                                    @if($res->tanggapan == '')
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @else
                                        <i class="fas fa-check-circle text-success"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($res->status == 'proses')
                                        <span class="badge badge-info">Sedang Di Proses</span>
                                    @elseif($res->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">     
                                        @if($res->status == 'selesai')
                                            <a href="{{ route('detail_tanggapan', $res->id_pengaduan) }}" class="btn btn-icon-split btn-sm btn-info">
                                                <span class="icon text-white-100">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <span class="text">Lihat</span>
                                            </a>
                                        @elseif($res->tanggapan == '')
                                            <a href="{{ route('tanggapi_aduan', $res->id_pengaduan) }}" class="btn btn-icon-split btn-sm btn-warning">
                                                <span class="icon text-white-100">
                                                    <i class="fas fa-info"></i>
                                                </span>
                                                <span class="text">Tanggapi</span>
                                            </a>
                                        @else
                                            <a href="#" data-id="{{ $res->id_pengaduan }}" data-toggle="modal" data-target="#finishModal" data-action="{{ route('selesai_tanggapan', $res->id_pengaduan) }}" class="btn btn-icon-split btn-sm btn-success">
                                                <span class="icon text-white-100">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Selesai</span>
                                            </a>
                                            <a href="{{ route('detail_tanggapan', $res->id_pengaduan) }}" class="btn btn-icon-split btn-sm btn-info">
                                                <span class="icon text-white-100">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <span class="text">Lihat</span>
                                            </a>
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
<!-- Modal VERIFY -->
<div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Yakin Aduan Sudah Di Tanggapi dan Selesai?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets') }}/admin/img/verified_illustrator.svg" id="img-info" class="img-fluid" width="300" alt="">
        <form id="formFinish" method="POST">
            @csrf
            <input type="hidden" name="id_pengaduan" id="idSelesai">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> Selesai</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END MODAL VERIFY -->
@endsection
@push('javascript')
<script>
    $(document).ready(function () {
        $('#tanggapan').DataTable({
            'search': true,
            'ordering': false,
            'iDisplayLength': 5
        });
    });

    $('#finishModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget);
        let id = button.data('id');
        let action = button.data('action');
        let modal = $(this);

        modal.find('.modal-body #idSelesai').val(id);
        modal.find('.modal-body #formFinish').attr('action', action);
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