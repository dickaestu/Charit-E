@extends('layouts.logistik.logistik')
@section('title','Detail Pengiriman Logistik')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent pl-0">
          <li class="breadcrumb-item"><a style="text-decoration: none"  href="{{ route('data-pengiriman-logistik') }}">Kembali</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Pengiriman</li>
        </ol>
      </nav>

      <table cellpadding="8" class="table-responsive table-borderless mb-3">
        <tr>
            <th>Keterangan Pengiriman </th>
            <td>:</td>
            <td>{{$pengiriman->keterangan_pengiriman}}</td>
        </tr>
    </table>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pengiriman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($items as $item )    
                            <tr>
                                <td>{{$loop->iteration}}</td>           
                                <td>{{$item->stokbarang->nama_barang}}</td>                       
                                <td>{{$item->jumlah}}</td>        
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