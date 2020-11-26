@forelse($ditolak as $p)
    <div class="card mt-3">
        <div class="card-header">
            Kategori Aduan : <span class="badge badge-success">{{ $p->kategori_aduan->nama_kategori }}</span>
        </div>
        <div class="card-body">
            <h5 class="card-text">Kode Aduan : <span class="badge badge-primary">{{ $p->id_pengaduan }}</span></h5>
            <h5 class="card-text">Kode Aduan : <span class="badge badge-primary">{{ $p->id_pengaduan }}</span></h5>
            <h5 class="card-text">Tanggal : {{ date('d-m-Y', strtotime($p->tgl_pengaduan)) }}</h5>
            <h5 class="card-text">Status :
                @if($p->deleted_at == null)
                    @if($p->status == '0')
                    <span class="badge badge-warning">Menunggu Verifikasi...</span>
                    @elseif($p->status == 'proses')
                        <span class="badge badge-info">Sedang Di Proses</span>
                    @elseif($p->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                    @else
                        <span class="badge badge-danger">Ditolak!</span>
                    @endif
                @else
                    <span class="badge badge-danger">Ditolak!</span>
                @endif
            </h5>
            <p class="card-text">{!! Str::substr($p->isi_laporan, 0, 20) !!}[...]</p><br>
            <a href="{{ route('lihat_aduan', $p->id_pengaduan) }}" class="btn btn-sm btn-info mt-2 mb-0"><i class="fa fa-eye"></i> Lihat Aduan</a>
        </div>
        <div class="card-footer text-muted">
            {{ $p->created_at->diffForHumans() }}
        </div>
    </div>
    @empty
    <div class="alert alert-warning mt-3" role="alert">
        <i class="fa fa-exclamation-triangle"></i>
        Aduan Yang Di Tolak Tidak Ada!
    </div>
    @endforelse