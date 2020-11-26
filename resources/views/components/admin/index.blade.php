@extends('components.admin.templates.header')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL SELURUH PENGADUAN MASYARAKAT</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calculator fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">PENGADUAN YANG BELUM DI VERIFIKASI</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $verify }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PENGADUAN YANG SEDANG DI PROSES</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $process }}</div>                
                <!-- <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div> -->
              </div>
              <div class="col-auto">
                <i class="fa fa-spinner fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">PENGADUAN YANG TELAH SELESAI</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $finish }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-check fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
          <div class="card-header"><h6 class="m-0 font-weight-bold text-success">GRAFIK SEMUA JUMLAH PENGADUAN BERDASARKAN TANGGAL PENGADUAN</h6></div>
          <div class="card-body">
            <canvas id="dashboardChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">3 PENGADUAN TERBARU</h6>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <th>No. Aduan</th>
                <th>Tanggal Pengaduan</th>
                <th>Dibuat</th>
                <th>Status</th>
              </thead>
              <tbody>
                @forelse($latest as $lat)
                <tr>
                  <td><span class="badge badge-primary">{{ $lat->id_pengaduan }}</span></td>
                  <td>{{ $lat->tgl_pengaduan }}</td>
                  <td>{{ $lat->created_at->diffForHumans() }}</td>
                  <td>
                    @if($lat->status == '0')
                    <span class="badge badge-warning">Belum Di Verifikasi</span>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4">
                    <div class="alert alert-warning">
                      <i class="fa fa-exclamation-triangle"></i> Data Kosong!
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('javascript')
<script>
  $(document).ready(function(){
      var ctx = document.getElementById('dashboardChart').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels:  {!!json_encode($chart->labels)!!} ,
              datasets: [
                  {
                      label: 'Jumlah Aduan Berdasarkan Tanggal',
                      backgroundColor: {!! json_encode($chart->colours)!!} ,
                      data:  {!! json_encode($chart->dataset)!!} ,
                  },
              ]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true,
                          callback: function(value) {if (value % 1 === 0) {return value;}}
                      },
                      scaleLabel: {
                          display: false
                      }
                  }]
              },
              yAxis: {
                  title: {
                      text: 'Jumlah Aduan'
                  }
              },
              legend: {
                  labels: {
                      fontColor: '#122C4B',
                      fontFamily: "'Muli', sans-serif",
                      padding: 25,
                      boxWidth: 25,
                      fontSize: 14,
                  }
              },
              layout: {
                  padding: {
                      left: 10,
                      right: 10,
                      top: 0,
                      bottom: 10
                  }
              }
          }
      });
    }); 
</script>
@endpush
