@extends('layouts.logistik.logistik')
@section('title','Data Barang Masuk')
@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    @if (session('sukses'))
    <div class="alert alert-danger" role="alert">
        {{session('sukses')}}
    </div>    
    @endif
    
    <a href="{{ route('data-barang-masuk-logistik.create') }}" class="btn btn-primary btn-icon mb-2"><i class="fas fa-plus"></i> Tambah Barang Masuk</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableBarangMasuk" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Barang Masuk</th>
                            <th>Tanggal Masuk</th>
                            <th>Created By</th>   
                            <th>Action</th>   
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->id_barang_masuk}}</td>
                            <td>{{$item->tanggal_barang_masuk}}</td>
                            <td>{{$item->user->name}}</td>
                            <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
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
    $(document).ready(function() {
        $('#tableBarangMasuk').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
    } );
    
</script>

@endpush