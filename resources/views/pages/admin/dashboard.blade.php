@extends('layouts.admin.admin')
@section('title','Dashboard')

@section('content')
<div class="container-fluid">
  @if (session('sukses'))
  <div class="alert alert-success">
      {{ session('sukses') }}</div>
  @endif
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Donasi Harian Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">donasi</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $donasi }}</div>
                <div class=" text-gray mt-1"> ({{ \Carbon\Carbon::now()->format('D, M - Y') }})</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-gift fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bencana Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Bencana (Bulanan)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bencana }}</div>
                <div class=" text-gray mt-1"> ({{ \Carbon\Carbon::now()->format('M - Y') }})</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Dana  -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User Donatur</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $user }}</div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Request Logistik
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $request_logistik }} Permintaan</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Area Chart -->
    <div class="row">
      {{-- Chart Batang --}}
     <div class="col-md-7 ">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <figure class="highcharts-figure">
            <div id="container"></div>
        
            <button class="btn btn-sm btn-primary" id="plain">Plain</button>
            <button class="btn btn-sm btn-success" id="inverted">Inverted</button>
            <button class="btn btn-sm btn-danger" id="polar">Polar</button>
        </figure>
        </div>
      </div>
    </div>


    {{-- Chart Pie --}}
    <div class="col-md-5 ">
      <div class="card shadow mb-4">
       
        <!-- Card Body -->
        <div class="card-body">
         
          <figure class="highcharts-figure">
              <div id="pie"></div>
            
          </figure>

        </div>
      </div>
    </div>
    </div>
    {{-- End Area Chart --}}
  </div>




@endsection

@push('addon-script')
<script src="{{ url('backend_assets/js/chart/highcharts.js') }}"></script>
<script src="{{ url('backend_assets/js/chart/highcharts-more.js') }}"></script>
<script src="{{ url('backend_assets/js/chart/exporting.js') }}"></script>
<script src="{{ url('backend/assets/js/chart/export-data.js') }}"></script>
<script src="{{ url('backend/assets/js/chart/accessibility.js') }}"></script>

<script>
    var chart = Highcharts.chart('container', {

        title: {
            text: 'Total Bencana Selama Tahun '+{!! Carbon\Carbon::now()->format('Y') !!}
        },

        subtitle: {
            text: ''
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },

        series: [{
            type: 'column',
            colorByPoint: true,
            data: {!! json_encode($data) !!},
            showInLegend: false
        }]

    });


    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });

// Pie Chart
    // Make monochrome colors
var pieColors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[5],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.color(base).brighten((i - 2) / 8).get());
    }
    return colors;
}());

// Build the chart
Highcharts.chart('pie', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Jenis Donasi'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            colors: pieColors,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
        name: 'Share',
        data: [
            { name: 'Donasi Pokok', y: {{ $pokok }} },
            { name: 'Donasi Uang', y: {{ $uang }}},
        ]
    }]
});
</script>    
@endpush