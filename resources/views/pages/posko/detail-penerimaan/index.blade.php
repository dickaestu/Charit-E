@extends('layouts.posko.posko')
@section('title','Detail Penerimaan')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid ">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>    
    @endif
    <nav class="breadcrumb bg-transparent pl-0">
        <a class="breadcrumb-item" href="{{ route('data-permintaan') }}">Kembali</a>
        <span class="breadcrumb-item active">Detail Penerimaan</span>
    </nav>
    
    <a href="{{ route('detail-penerimaan-posko.create',$id_penerimaan_barang) }}" class="btn btn-primary mb-2">Tambah Detail Penerimaan Barang</a>
    
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Penerimaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($items as $item )    
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->stokbarang->nama_barang}} / {{$item->stokbarang->satuan}}</td>
                            <td>{{$item->jumlah}}</td>        
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('detail-penerimaan-posko.edit',$item->id_detail_penerimaan_barang) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                                    @if (count($items) >1)
                                    <form action="{{ route('detail-penerimaan-posko.destroy',$item->id_detail_penerimaan_barang) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                    </form>
                                    @endif
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
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable( {
        } );
    } );    
</script>    

@endpush