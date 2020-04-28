@extends('layouts.logistik.logistik')
@section('title','Detail Pengiriman Logistik')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

<div class="row">
    <div class="col-auto col-md-6">
        <label for="keterangan">Keterangan Pengiriman</label>
<textarea name="keterangan" id="keterangan" class="form-control mb-4" rows="3">{{$pengiriman->keterangan_pengiriman}}</textarea>
    </div>
</div>
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