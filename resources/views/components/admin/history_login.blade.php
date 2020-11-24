@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">History Login Petugas</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="history" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Terakhir Online</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $hs)
                        <tr>
                            <td>{{ empty($i) ? $i = 1 : ++$i }}</td>
                            <td>{{ $hs->nama_petugas }}</td>
                            <td>{{ $hs->username }}</td>
                            <td>
                                @if(Cache::has('is_online' . $hs->id))
                                    <span class="fa fa-circle text-success"></span> Online
                                @else
                                    <span class="fa fa-circle text-danger"></span> Offline
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($hs->last_seen)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(function(){
        $('#history').DataTable({
            'search':true,
            'iDisplayLength': 5
        });
    })
</script>
@stop