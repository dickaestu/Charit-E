@extends('layouts.logistik.logistik')
@section('title','Data Pengeluaran Uang')
    

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>    
    @endif

    <a href="{{route('tambah-pengeluaran')}}" class="btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengeluaran</a>

    <table cellpadding="8" class="table-responsive table-borderless mb-3">
        <tr>
            <th>Total Pengeluaran </th>
            <td>:</td>
            <td style="font-size:20px" class="text-dark">@currency($total)</td>
        </tr>
    </table>        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran Uang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengeluaran</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Keterangan Pengeluaran</th>
                            <th>Total Pengeluaran</th>
                            <th>Detail Pengeluaran</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id_pengeluaran_uang }}</td>
                                <td>{{ Carbon\Carbon::create($item->tanggal_pengeluaran)->format('d - m - Y') }}</td>
                                <td>{{ $item->keterangan_pengeluaran }}</td>
                                <td>@currency($item->total_pengeluaran)</td>
                                <td class="text-center"> 
                                    <a class="btn btn-sm btn-info" href="{{ route('detail-pengeluaran-logistik',$item->id_pengeluaran_uang) }}">Lihat Detail</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection




@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>
@endpush

    