@extends('layouts.logistik.logistik')
@section('title','Laporan Stok Barang')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <a href="{{ route('export-stok-barang') }}" target="_blank" class="btn btn-primary mb-2">Cetak</a>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Stok Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableStok" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Stok Barang</th>
                            <th>Nama Barang</th>
                            <th>Quantity</th>
                            <th>Satuan</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id_stok_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->satuan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



@endsection
     

@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function(){
            $('#tableStok').DataTable({
              
            });
        });
    </script>
@endpush
 