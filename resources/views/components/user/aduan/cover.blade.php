<h2 class="text-center mt-3">Laporan Data Aduan</h2>
    <div class="d-flex justify-content-center text-center">
        <div class="" style="margin-top: 5em;">
            <img width="500" src="{{ asset('assets') }}/admin/img/report-illustration.svg" class="img-fluid" alt="">
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th colspan="3" class="text-center">Aplikasi Pelaporan Pengaduan Masyarakat</th>
            </tr>
            <tr>
                <th>No Aduan.</th>
                <th>:</th>
                <th>{{ $id->id_pengaduan }}</th>
            </tr>
            <tr>
                <th>Di Cetak Pada Tanggal</th>
                <th>:</th>
                <th>{{ date('d M Y, H:i:s') }}</th>
            </tr>
            <tr>
                <th colspan="3" class="text-center">Detail Aduan dan Hasil Tanggapan</th>
            </tr>
        </table>
    </div>