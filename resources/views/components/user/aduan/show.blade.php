@extends('components.user.layout.header')
@section('section-hero')
<div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
    <div>
    <h1>Lihat Aduan</h1>
    </div>
</div>
<div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
    <img src="{{ asset('assets') }}/img/show-illustration.svg" class="img-fluid" alt="">
</div>
@endsection
@section('content-user')
<section id="login">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-12">
                <a href="{{ route('user_dashboard') }}" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
                <table class="table table-bordered mt-3">
                  <tbody>
                    <tr>
                      <th colspan="3" class="text-center">Detail Aduan</th>
                    </tr>
                    <tr>
                      <th>Kode Aduan</th>
                      <th>:</th>
                      <td>{{ $show->id_pengaduan }}</td>
                    </tr>
                    <tr>
                      <th>Kategori Aduan</th>
                      <th>:</th>
                      <td>{{ $show->kategori_aduan->nama_kategori }}</td>
                    </tr>
                    <tr>
                      <th>Tanggal Aduan</th>
                      <th>:</th>
                      <td>{{ date('d-M-Y', strtotime($show->tgl_pengaduan)) }}</td>
                    </tr>
                    <tr>
                      <th>Isi Laporan (Aduan)</th>
                      <th>:</th>
                      <td>{!! $show->isi_laporan !!}</td>
                    </tr>
                    <tr>
                      <th>Bukti Gambar (Foto)</th>
                      <th>:</th>
                      <td>
                        @foreach(json_decode($show->foto) as $foto)
                        <img src="{{ asset('assets/uploads/'.$foto) }}" width="100" alt="">
                        @endforeach
                      </td>
                    </tr>
                    <tr>
                      <th>Status</th>
                      <th>:</th>
                      <td>
                        @if($show->status == '0')
                        <span class="badge badge-warning">BELUM DI VERIFIKASI</span>
                        @elseif($show->status == 'proses')
                        <span class="badge badge-info">SEDANG DI PROSES</span>
                        @elseif($show->status == 'selesai')
                        <span class="badge badge-success">SELESAI</span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('nav-user')
<li class=""><a href="#"><i class="fa fa-user"></i> Selamat Datang, {{ Auth::guard('masyarakat')->user()->nama_lengkap }}</a></li>
<li class=""><a href="#" data-toggle="modal" data-target="#confLogout"><i class="fa fa-sign-out"></i> Logout</a></li>
@endsection