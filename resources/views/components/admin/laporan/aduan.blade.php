<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>laporan_aduan({{ date('d-M-Y') }})</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style type="text/css">
      @media print {
        body{
            width: 21cm;
            height: 29.7cm;
            margin: 30mm 30mm 30mm 30mm; 
            /* change the margins as you want them to be. */
        } 
        .footer,
        #non-printable {
            display: none !important;
        }
        #printable {
            display: block;
        }
    }
  </style>
</head>
    <h2 class="text-center mt-3">Laporan Data Aduan</h2>
    <div class="d-flex justify-content-center">
        <div class="" style="margin-top: 10em;">
            <img width="700" src="{{ asset('assets') }}/admin/img/report-illustration.svg" class="img-fluid" alt="">
        </div>
    </div>
    <table class="table table-bordered mt-3">
        <tr>
            <th colspan="3" class="text-center">Aplikasi Pelaporan Pengaduan Masyarakat</th>
        </tr>
        <tr>
            <th>Jumlah Data</th>
            <th>:</th>
            <th>{{ $jml }}</th>
        </tr>
        <tr>
            <th colspan="3" class="text-center">Rentang Tanggal</th>
        </tr>
        <tr>
            <th colspan="3" class="text-center">{{ $tgl }}</th>
        </tr>
        <tr>
            <th>Di Cetak Pada Tanggal</th>
            <th>:</th>
            <th>{{ date('d M Y H:i:s') }}</th>
        </tr>
    </table>
    <div style="margin-top: 45em;"></div>
    <div class="container">
    @foreach($detail as $de)
        <h3>A. Detail Data Aduan No. {{ $de->id_pengaduan }}</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>No Aduan</th>
                    <th>:</th>
                    <th>{{ $de->id_pengaduan }}</th>
                </tr>
                <tr>
                    <th>NIK Pelapor</th>
                    <th>:</th>
                    <th>{{ $de->nik }}</th>
                </tr>
                <tr>
                    <th>Nama Pelapor</th>
                    <th>:</th>
                    <th>{{ $de->masyarakat->nama_lengkap }}</th>
                </tr>
                <tr>
                    <th>Tanggal Aduan</th>
                    <th>:</th>
                    <th>{{ date('d-M-Y', strtotime($de->tgl_pengaduan)) }}</th>
                </tr>
                <tr>
                    <th>Kategori Aduan</th>
                    <th>:</th>
                    <th>{{ $de->kategori_aduan->nama_kategori }}</th>
                </tr>
                <tr>
                    <th>Isi Laporan</th>
                    <th>:</th>
                    <th>{!! $de->isi_laporan !!}</th>
                </tr>
                <tr>
                    <th>Bukti Foto</th>
                    <th>:</th>
                    <th><img src="{{ asset('assets/uploads/'.$de->foto) }}" width="120" alt=""></th>
                </tr>
            </tbody>
        </table>
    <h3>B. Detail Data Tanggapan</h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Tanggal Di Tanggapi</th>
                <th>:</th>
                <th>{{ $de->tgl_tanggapan }}</th>
            </tr>
            <tr>
                <th>Di Tanggapi Oleh Petugas</th>
                <th>:</th>
                <th>{{ $de->petugas->nama_petugas }}</th>
            </tr>
            <tr>
                <th>Isi Tanggapan</th>
                <th>:</th>
                <th>{{ $de->tanggapan }}</th>
            </tr>
            <tr>
                <th>Tanggal Aduan</th>
                <th>:</th>
                <th>{{ date('d-M-Y', strtotime($de->tgl_pengaduan)) }}</th>
            </tr>
            <tr>
                <th>Status</th>
                <th>:</th>
                <th>{{ $de->status }}</th>
            </tr>
        </tbody>
    </table>
    @endforeach
    </div>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>
</html>