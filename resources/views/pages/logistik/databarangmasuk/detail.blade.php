@extends('layouts.logistik.logistik')
@section('title','Detail Barang Masuk')
@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>    
    @endif
    
    <nav class="breadcrumb bg-transparent">
        <a class="breadcrumb-item" href="{{ route('data-barang-masuk-logistik') }}">Kembali</a>
        <span class="breadcrumb-item active">Detail {{ $id_barang_masuk }}</span>
    </nav>

    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableBarangMasuk" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$item->stokBarang->nama_barang}}</td>
                            <td>{{$item->jumlah}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('data-barang-masuk-logistik.detail.edit',$item->id_detail_barang_masuk) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                                    {{-- <form action="{{ route('data-barang-masuk-logistik.detail.delete',$item->id_detail_barang_masuk) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                    </form> --}}
                                </div>
                            </td>
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
        } );
    } );
    
</script>

@endpush