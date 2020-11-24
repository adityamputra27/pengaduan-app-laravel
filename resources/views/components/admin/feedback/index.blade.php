<!-- @if(session('errors'))
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
        	<i class="fa fa-exclamation-triangle"></i> <span class="text-danger">{{ $error }}</span>
        </div>
    @endforeach
@endif -->
@if(session('errors'))
<div class="alert alert-danger" role="alert">
	<i class="fa fa-exclamation-triangle"></i> <b>Terjadi Kesalahan!</b>
</div>
@endif