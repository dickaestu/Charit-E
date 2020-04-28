@extends('layouts.logistik.logistik')
@section('title','Permintaan Logistik')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
  



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Permintaan Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Permintaan</th>
                            <th>Tanggal Permintaan</th>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($items as $item)
                       <tr>
                        <td>{{$item->id_permintaan_barang}}</td>
                        <td>{{\Carbon\Carbon::create($item->tanggal_permintaan)->format('d - m - Y')}}</td>
                        <td>{{$item->infoposko->user->name}}</td>
                        <td>{{$item->infoposko->alamat_posko}}</td>
                        <td>{{$item->keterangan_permintaan}}</td>
                    
                        <td>
                        <a href="{{route('detail-permintaan-logistik',$item->id_permintaan_barang)}}"
                                class="btn btn-sm btn-info ">Detail</a>              
                       
                        <a href="{{route('create-pengiriman',$item->id_permintaan_barang)}}" class="btn btn-sm btn-success btn-block mt-1">Buat Pengiriman</a>
                        </td>
                    </tr>

                       @empty
                           <tr>
                               <td colspan="6" class="text-center">Data Kosong</td>
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