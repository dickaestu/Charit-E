@extends('layouts.admin.admin')
@section('title','Detail Sub Posko')

@section('content')
<nav class="ml-3" aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item"><a style="text-decoration: none"  href="{{ route('data-info-posko') }}">Kembali</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Sub Posko</li>
    </ol>
</nav>
<!-- Begin Page Content -->
<div class="container-fluid ">
    
    <a href="{{ route('print-sub-posko-admin',$id) }}" class="btn btn-sm btn-primary ml-2 mb-2 shadow-sm">Cetak</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Sub Posko</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableSubPosko" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sub Posko</th>
                            <th>Nama Penanggung Jawab</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_sub_posko}}</td>
                            <td>{{$item->nama_penanggung_jawab}}</td>
                            
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


@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush


@push('addon-script')
<!-- Page level plugins -->
<script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#tableSubPosko').DataTable({                
        });
    });
</script>
@endpush