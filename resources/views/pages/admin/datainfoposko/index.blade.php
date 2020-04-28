@extends('layouts.admin.admin')
@section('title','Info Posko')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Info Posko</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Tanggal Kejadian</th>
                            <th>Nama Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Jumlah Korban</th>
                            <th>Jumlah Korban Jiwa</th>
                            <th>Jumlah Sub Posko</th>
                            <th>Detail Sub Posko</th>

                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($items as $item)
                            <tr>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->alamat_posko}}</td>
                                <td>{{Carbon\Carbon::create($item->tanggal_kejadian)->format('d-m-Y')}}</td>
                                <td>{{$item->jenis_bencana->nama_bencana}}</td>
                                <td>{{$item->lokasi_bencana}}</td>
                                <td>{{$item->jumlah_korban}}</td>
                                <td>{{$item->jumlah_korban_jiwa}}</td>
                                <td>{{$item->subposko->count()}}</td>
                                <td>
                                <a href="{{route('detail-data-subposko',$item->id_info_posko)}}" class="btn btn-sm btn-info btn-inline">Detail</a>
                                </td>
                            </tr>
                       @empty
                           <tr>
                               <td colspan="9" class="text-center">Data Kosong</td>
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