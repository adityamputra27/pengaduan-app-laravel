@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('kelola_tanggapan') }}" class="btn btn-info mb-3"><i class="fa fa-chevron-left"></i> Kembali</a>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-detail-aduan" data-toggle="tab" href="#nav-aduan" role="tab" aria-controls="nav-home" aria-selected="true">Detail Aduan</a>
                    <a class="nav-item nav-link" id="nav-detail-tanggapan" data-toggle="tab" href="#nav-tanggapan" role="tab" aria-controls="nav-contact" aria-selected="false">Detail Tanggapan</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-aduan" role="tabpanel" aria-labelledby="nav-detail-aduan">
                    <table class="table table-bordered mt-3">
                        <tr>
                            <th colspan="3"><h3>A. Detail Data Aduan</h3></th>
                        </tr>
                        <tr>
                            <th>No Aduan.</th>
                            <th>:</th>
                            <td><button class="btn btn-success btn-lg">{{ $detail->id_pengaduan }}</button></td>
                        </tr>
                        <tr>
                            <th>NIK Pelapor</th>
                            <th>:</th>
                            <td>{{ $detail->nik }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pelapor</th>
                            <th>:</th>
                            <td>{{ $detail->masyarakat->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Aduan</th>
                            <th>:</th>
                            <td>{{ date('d-M-Y', strtotime($detail->tgl_pengaduan)) }}</td>
                        </tr>
                        <tr>
                            <th>Kategori Aduan</th>
                            <th>:</th>
                            <td><span class="badge badge-primary">{{ $detail->kategori_aduan->nama_kategori }}</span></td>
                        </tr>
                        <tr>
                            <th colspan="3">Isi Laporan (Aduan)</th>
                        </tr>   
                        <tr>
                            <td colspan="3">{!! $detail->isi_laporan !!}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <th>:</th>
                            <td>
                                @foreach(json_decode($detail->foto) as $foto)
                                <img width="100" src="{{ asset('assets/uploads/' . $foto) }}" alt="">
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-tanggapan" role="tabpanel" aria-labelledby="nav-detail-tanggapan">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="3"><h3>B. Detail Data Tanggapan</h3></th>
                        </tr>
                        <tr>
                            <th>Tanggal Ditanggapi</th>
                            <th>:</th>
                            <td>{{ date('d-M-Y', strtotime($detail->tgl_tanggapan)) }}</td>
                        </tr>
                        <tr>
                            <th>Ditanggapi Oleh Petugas</th>
                            <th>:</th>
                            <td><button class="btn btn-info btn-lg">{{ $detail->petugas->nama_petugas }}</button>
                        </tr>
                        <tr>
                            <th colspan="3">Isi Tanggapan</th>
                        </tr>
                        <tr>
                            <td colspan="3">{!! $detail->tanggapan !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td><span class="badge badge-success">{{ Str::upper($detail->status) }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
