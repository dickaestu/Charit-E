@extends('layouts.logistik.logistik')
@section('title','Data Pengiriman Logistik')

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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengiriman</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($items as $item)
                       <tr>
                        <td>{{$item->id_pengiriman_barang}}</td>
                        <td>{{\Carbon\Carbon::create($item->tanggal_pengiriman)->format('d - m - Y')}}</td>
                        <td>{{$item->permintaanbarang->infoposko->user->name}}</td>
                        <td>{{$item->permintaanbarang->infoposko->alamat_posko}}</td>
                        <td>{{$item->permintaanbarang->infoposko->jenis_bencana->nama_bencana}}</td>
                        <td>{{$item->permintaanbarang->infoposko->lokasi_bencana}}</td>
                    
                        <td>
                        <a href="{{route('detail-pengiriman-logistik', $item->id_pengiriman_barang)}}"
                                class="btn btn-sm btn-info btn-inline">Detail Pengiriman</a>              
                       
                        </td>
                    </tr>

                       @empty
                           <tr>
                               <td colspan="7" class="text-center">Data Kosong</td>
                           </tr>
                       
                       @endforelse


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