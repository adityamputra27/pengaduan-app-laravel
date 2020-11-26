@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Tanggapi Aduan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="{{ route('kelola_tanggapan') }}" class="btn btn-icon-split btn-info">
                <span class="icon text-white-100">
                <i class="fas fa-chevron-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

            <!-- FORM -->
            <form action="{{ route('tanggapi_aduan.simpan') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="id_pengaduan" value="{{ $id->id_pengaduan }}">
                <div class="form-group">
                    <label for="">Tanggal Tanggapan :</label>
                    <input type="text" name="tgl_tanggapan" readonly value="{{ date('Y-m-d') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Isi Tanggapan :</label>
                    <textarea name="tanggapan" id="isi_tanggapan" class="form-control"></textarea>
                    @error('tanggapan')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <!-- <div class="form-group">
                    <label for="">Status :</label>
                    <select name="status" class="form-control" id="">
                        <option value="">Pilih Status</option>
                        <option value="proses">Sedang Di Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status :</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Sedang Di Proses</option>
                        <option value="">Selesai</option>
                        <option value="">Tolak</option>
                    </select>
                </div> -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> Simpan Tanggapan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('javascript')
<script>
    ClassicEditor
    .create( document.querySelector( '#isi_tanggapan' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );
</script>
@endpush