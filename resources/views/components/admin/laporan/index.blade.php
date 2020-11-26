@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h3 mb-2 text-gray-800">Pilih Laporan</h1>
        </div>
        <div class="card-body">
            <form action="" method="POST" id="formLaporan">
                @csrf
                <div class="form-group">
                    <select id="selectLaporan" class="form-control">
                        <option value="">--</option>
                        <option value="MASYARAKAT">LAPORAN DATA MASYARAKAT</option>
                        <option value="PETUGAS">LAPORAN DATA PETUGAS</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block" id="submitLaporan"><i class="fa fa-print"></i> Cetak Laporan</button>
                </div>
            </form>
            <!-- <table class="table table-bordered">
                <thead>
                    <tr align="center">
                        <th>Laporan</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DATA PETUGAS</td>
                        <td align="center"><a href="" class="btn btn-danger"> <i class="fa fa-file-pdf"></i></a></td>
                        <td align="center"><a href="" class="btn btn-primary"> <i class="fa fa-download"></i></a></td>
                        <td align="center"><a href="" class="btn btn-success"> <i class="fa fa-file-excel"></i></a></td>
                    </tr>
                    <tr>
                        <td>DATA MASYARAKAT</td>
                        <td align="center"><a href="" class="btn btn-danger"> <i class="fa fa-file-pdf"></i></a></td>
                        <td align="center"><a href="" class="btn btn-primary"> <i class="fa fa-download"></i></a></td>
                        <td align="center"><a href="" class="btn btn-success"> <i class="fa fa-file-excel"></i></a></td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Laporan Aspirasi</h1>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-row">
                            <div class="col">
                                <label for="">Dari Tanggal :</label>
                                <input type="text" id="dari_tgl_aduan" placeholder="Tanggal Awal" class="form-control">
                            </div>
                            <div class="col">
                                <label for="">Sampai Tanggal :</label>
                                <input type="text" id="sampai_tgl_aduan" placeholder="Tanggal Akhir" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block mt-3"><i class="fa fa-print"></i> Cetak Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Laporan Aduan</h1>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> Perlu Diingat Bahwa Laporan Aduan Ini Adalah Data Yang Sudah Di Verifikasi, Di Berikan Tanggapan Dan Statusnya Adalah Selesai.
                    </div>
                    <form action="{{ route('laporan_aduan') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="">Dari Tanggal :</label>
                                <input type="text" required name="tglawal" id="dari_tgl_aduan" placeholder="Tanggal Awal" class="form-control">
                            </div>
                            <div class="col">
                                <label for="">Sampai Tanggal :</label>
                                <input type="text" required name="tglakhir" id="sampai_tgl_aduan" placeholder="Tanggal Akhir" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <button formtarget="_blank" class="btn btn-success btn-block mt-3"><i class="fa fa-print"></i> Cetak Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('javascript')
<script>
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

    $('body').on('click', '#submitLaporan', function(e){
        // e.preventDefault();
        let petugas = '{{ route("laporan_petugas") }}';
        let masyarakat = '{{ route("laporan_masyarakat") }}';
        let value = $('#selectLaporan').val();
        if (value == 'PETUGAS') 
        {
            $('#formLaporan').attr('action', petugas);
        } 
        else if(value == 'MASYARAKAT')
        {
            $('#formLaporan').attr('action', masyarakat);
        }
        else
        {
            e.preventDefault();
            Swal.fire({
              icon: 'error',
              title: 'Laporan Tidak Ada!',
              showConfirmButton: false,
              timer: 3000
            });
            window.location.href = "{{ route('laporan_home') }}";
        }
    });

    $(document).ready(function(){
        $('#dari_tgl_aduan, #sampai_tgl_aduan, #dari_tgl_aspirasi, #sampai_tgl_aspirasi').datepicker({
            format: 'yyyy-mm-dd',
            locale: 'id',
            autoclose: true,
            todayHighlight: true,
        });

        $('#dari_tgl_aduan').on('changeDate', function(selected){
            var startDate = new Date(selected.date.valueOf());
            $('#sampai_tgl_aduan').datepicker('setStartDate', startDate);
            if($('#dari_tgl_aduan').val() > $('#sampai_tgl_aduan').val()){
                $('#sampai_tgl_aduan').val($('#dari_tgl_aduan'));
            }
        }); 
        $('#dari_tgl_aspirasi').on('changeDate', function(selected){
            var startDate = new Date(selected.date.valueOf());
            $('#sampai_tgl_aspirasi').datepicker('setStartDate', startDate);
            if($('#dari_tgl_aspirasi').val() > $('#sampai_tgl_aspirasi').val()){
                $('#sampai_tgl_aspirasi').val($('#dari_tgl_aspirasi'));
            }
        }); 

        // $('#form_laporan').submit(function(){
        //     // event.preventDefault();
        //     var laporan = $('#laporan').val();
        //     var data = new FormData(this);
        //     if(laporan == 'PETUGAS'){
        //         $.ajax({
        //            url: "{{ route('laporan_petugas') }}",
        //            method: "POST",
        //            data:request,
        //            contentType: false,
        //            cache: false,
        //            processData: false,
        //            success:function(data)
        //            {
        //                window.location = "route('laporan_home')";
        //            }
        //         });
        //     }  
        // });
    });

</script>
@endpush