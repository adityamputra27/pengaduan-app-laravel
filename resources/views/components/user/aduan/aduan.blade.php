@extends('components.user.layout.header')
@section('section-hero')
<div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
    <div>
    <h1>Aduan</h1>
    </div>
</div>
<div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
    <img src="{{ asset('assets') }}/img/aduan.svg" class="img-fluid" alt="">
</div>
@endsection
@section('content-user')
<section id="login">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-success">Silahkan Buat Aduan Disini!</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.simpan_aduan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="text-success">Kode :</label>
                                <input type="text" class="form-control" readonly name="id_pengaduan" value="{{ $max4 }}">
                            </div>
                            <div class="form-group">
                                <label class="text-success" for="">Isi Laporan (Aduan)</label>
                                <textarea name="isi_laporan" id="isi_laporan" class="form-control" cols="30" rows="15"></textarea>
                                <span class="text-danger">@error('isi_laporan'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-success">Kategori Aduan</label>
                                <select name="id_kategori" class="form-control">
                                    <option value="">PILIH KATEGORI</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('id_kategori'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="">Bukti Gambar (Foto)</label>
                                <div class="custom-file">
                                    {{-- <input type="file" onchange="preview_image();" name="foto[]" id="buktiGambar" required multiple class="custom-file-input">
                                    <label class="custom-file-label">Pilih File...</label> --}}
                                    <input type="file" name="foto[]" id="buktiGambar" multiple class="custom-file-input">
                                    <label class="custom-file-label">Pilih File...</label>
                                </div>
                                <div class="mt-3 previewFoto"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><span class="fa fa-send"></span> Kirim Aduan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('nav-user')
{{-- <li class="active"><a href="{{ url('') }}">Beranda</a></li> --}}
<li class=""><a href="#"><i class="fa fa-user"></i> Selamat Datang, {{ Auth::guard('masyarakat')->user()->nama_lengkap }}</a></li>
<li class=""><a href="{{ url('') }}"><i class="fa fa-edit"></i> Edit Profile</a></li>
<li class=""><a href="{{ route('masyarakat_logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
@endsection
@push('javascript')
    <script>
        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
                
        //         reader.onload = function(e) {
        //         $('#uploads').attr('src', e.target.result);
        //         }
                
        //         reader.readAsDataURL(input.files[0]); // convert to base64 string
        //     }   
        // }

        // $("#buktiGambar").change(function() {
        //     readURL(this);
        // });
        // function preview_image()
        // {
        //     var total_file = document.getElementById("buktiGambar").files.length;
        //     for(var i=0; i < total_file; i++)
        //     {
        //         $('#uploads').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
        //     }
        // }
        $(document).ready(function(){
            var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img width="100" style="padding-left: 10px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#buktiGambar').on('change', function() {
                imagesPreview(this, 'div.previewFoto');
            });
        });
        ClassicEditor
            .create(document.querySelector( '#isi_laporan' ))
            .then(editor => {
                    console.log( editor );
            })
            .catch( error => {
                console.error( error );
        });
    </script>
@endpush