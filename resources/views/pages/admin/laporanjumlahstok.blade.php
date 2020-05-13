@extends('layouts.admin.admin')
@section('title','Laporan Jumlah Stok')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <a href="{{ route('export-jumlah-stok-barang-admin') }}" class="btn btn-primary mb-2">Cetak</a>
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Jumlah Stok Barang</h6>
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
    <script>
        $(document).ready(function(){
            $('#tableStok').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.jumlah.stok.barang') }}",
                columns:[
                  
                    {data:'id_stok_barang',name:'id_stok_barang'},
                    {data:'nama_barang',name:'nama_barang'}, 
                    {data:'quantity',name:'quantity'},
                    {data:'satuan',name:'satuan'},
                ]
            });
        });
    </script>
@endpush