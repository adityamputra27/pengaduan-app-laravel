<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Laporan Petugas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
    <h2 class="text-center">Laporan Data Petugas</h2>
    <br>
    <table>
        <tbody>
            <tr>
                <th colspan="3">Detail Aplikasi</th>
                <th>:</th>
                <th>Aplikasi Pelaporan Pengaduan Masyarakat</th>
            </tr>
            <tr>
                <th colspan="3">Jumlah Data</th>
                <th>:</th>
                <th>{{ $jumlah }} Data</th>
            </tr>
            <tr>
                <th colspan="3">Daftar Laporan Data Petugas</th>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <tbody>
            <tr class="bg-info">
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No. Telepon</th>
                <th>Terakhir Login</th>
            </tr>
            @foreach($petugas as $key => $pe)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $pe->nama_petugas }}</td>
                <td>{{ $pe->username }}</td>
                <td>{{ $pe->telp }}</td>
                <td>{{ \Carbon\Carbon::parse($pe->last_seen)->diffForHumans() }}</td>
            </tr>
        </tbody>
        @endforeach
        <tfoot>
            <tr class="bg-light">
                <th colspan="2">Dicetak Pada Tanggal</th>
                <th>:</th>
                <th colspan="2">{{ date('d-M-Y H:i:s') }}</th>
            </tr>
        </tfoot>
    </table>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>