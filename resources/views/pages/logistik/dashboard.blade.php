 @extends('layouts.logistik.logistik')
@section('title','Dashboard')
    
@section('content')
 <!-- Begin Page Content -->
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
      <!-- Permintaan logistik Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Permintaan Logistik</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $request_logistik }} Request</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

     

     
    </div>

     <!-- Area Chart -->
     <div class="row">
      {{-- Chart Batang --}}
     <div class="col-md-12 ">
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


  
    </div>
    {{-- End Area Chart --}}
  </div>



  <!-- /.container-fluid -->

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
        text: 'Daftar Barang Yang Sering Dikirim'
    },

    subtitle: {
        text: ''
    },

    xAxis: {
        categories: {!! json_encode($stok_barang) !!}
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: {!! json_encode($jumlah) !!},
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

</script>    
@endpush
 
