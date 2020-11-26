<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="author" href="humans.txt">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    	@if(count($show) > 0)
        	@foreach($show as $sh)
        	<div class="card mb-3">
        		<div class="card-header">
        			Hasil Pencarian
        		</div>
        		<div class="card-body">
        			<h5 class="card-text">Kode Aduan : {{ $sh->id_pengaduan }}</h5>
        			<h5 class="card-text">Tanggal Aduan : {{ date('d-M-Y', strtotime($sh->tgl_pengaduan)) }}</h5>
        		</div>
        		<div class="card-footer">
        			<a href="{{ route('lihat_aduan', $sh->id_pengaduan) }}" class="btn btn-info">Lihat Aduan</a>
        		</div>
        	</div>
        	@endforeach
        @else
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i> <b>Hasil Pencarian Tidak Ada!</b>
        </div>
    	@endif
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>