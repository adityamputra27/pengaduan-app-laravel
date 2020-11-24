<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title></title>
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
    @include('components.user.aduan.cover')
    <div style="margin-top: 10em; margin-bottom: 10em;"></div>
    <p class="">Berdasarkan aduan atau laporan yang anda ajukan pada tanggal <b>{{ date('d-M-Y', strtotime($detail->tgl_pengaduan)) }}</b> telah dilakukan verifikasi dan proses lebih lanjut mengenai aduan atau laporan anda. Berikut detail data aduan anda :</p>
    <h5>A. Detail Data Aduan</h5>
    <table class="table table-bordered">
        <tr>
            <th>No. Aduan</th>
            <th>:</th>
            <th>{{ $detail->id_pengaduan }}</th>
        </tr>
        <tr>
            <th>NIK</th>
            <th>:</th>
            <th>{{ $detail->nik }}</th>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <th>:</th>
            <th>{{ $detail->masyarakat->nama_lengkap }}</th>
        </tr>
        <tr>
            <th>Tanggal Pengaduan</th>
            <th>:</th>
            <th>{{ date('d-m-Y', strtotime($detail->tgl_pengaduan)) }}</th>
        </tr>
        <tr>
            <th>Kategori Pengaduan</th>
            <th>:</th>
            <th>{{ $detail->kategori_aduan->nama_kategori }}</th>
        </tr>
    </table>
    <b>Isi Aduan (Laporan) :</b>
    <table class="table table-bordered">
        <tr>
            <th colspan="3">{!! $detail->isi_laporan !!}</th>
        </tr>
    </table>
    <b>Bukti (Foto) :</b>
    <table class="table table-bordered">
        <tr>
            <th colspan="3" class="text-center"><img src="{{ asset('assets/uploads/'.$detail->foto) }}" width="200" alt=""></th>
        </tr>
    </table>
    <p>Berikut hasil tanggapan daripada aduan yang anda ajukan, aduan tersebut akan di proses dan direalisasikan oleh petugas dan pihak yang bersangkutan lainnya.</p>
    <h5>B. Hasil Tanggapan</h5>
    <table class="table table-bordered">
        <tr>
            <th>Tanggal Di Tanggapi</th>
            <th>:</th>
            <th>{{ date('d-m-Y', strtotime($detail->tgl_tanggapan)) }}</th>
        </tr>
        <tr>
            <th>Di Tanggapi Oleh (Petugas)</th>
            <th>:</th>
            <th>{{ $detail->petugas->nama_petugas }}</th>
        </tr>
    </table>
    <div style="margin-top: 4em;"></div>
    <b>Isi Tanggapan :</b>
    <table class="table table-bordered">
        <tr>
            <th colspan="3">{!! $detail->tanggapan !!}</th>
        </tr>
    </table>
    <b>Status :</b>
    <table class="table table-bordered">
        <tr>
            <th colspan="3" class="text-center"><h5 style="font-family: 'Poppins';">{{ Str::upper($detail->status) }}</h5></th>
        </tr>
    </table>
    <div class="ttd">
        <p class="text-center">Salam Kami,</p>
        <p class="text-center mt-4"><span class="text-muted">{{ $detail->petugas->nama_petugas }}</span></p>
        <p class="text-center mt-4">Petugas</p>
    </div>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>