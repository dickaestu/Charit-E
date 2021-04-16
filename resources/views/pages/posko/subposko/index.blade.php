@extends('layouts.posko.posko')
@section('title','Data Sub Posko')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid ">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>    
    @endif
    
    <nav class="breadcrumb bg-transparent p-0">
        <a class="breadcrumb-item" href="{{ route('info-posko.index') }}">Kembali</a>
        <span class="breadcrumb-item active">Sub Posko</span>
    </nav>
    
    <a href="{{route('sub-posko.create',$id_info_posko)}}" class="btn btn-primary mb-3">Tambah</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Daftar Sub Posko</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableSubPosko" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sub Posko</th>
                            <th>Nama Penanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_sub_posko}}</td>
                            <td>{{$item->nama_penanggung_jawab}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a  href="{{route('sub-posko.edit', $item->id_sub_posko)}}"
                                        class="btn btn-warning btn-sm mr-1">Edit</a>
                                        <form  action="{{route('sub-posko.destroy',$item->id_sub_posko)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button name="hapus" id="hapus" 
                                            class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>
                                            
                                        </form>       
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
            $('#tableSubPosko').DataTable( {
            } );
        } );
        
    </script>
    
    @endpush