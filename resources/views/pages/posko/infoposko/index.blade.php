@extends('layouts.posko.posko')
@section('title','Info Posko')



@section('content')

<!-- Begin Page Content -->
<div class="container-fluid ">
    <h3>Info Posko</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>       
    @endif
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
    </div>    
    @endif
    @if (session('edit'))
    <div class="alert alert-success" role="alert">
        {{session('edit')}}
    </div>    
    @endif
    
    @if (session('hapus'))
    <div class="alert alert-success" role="alert">
        {{session('hapus')}}
    </div>    
    @endif
    <div class="col mt-4">
        <a href="{{route('info-posko.create')}}" class="btn btn-sm btn-primary shadow-sm mb-4">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Info Posko</a>
            
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Info Posko</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableInfo" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Info Posko</th>
                                    <th>Penanggung Jawab</th>
                                    <th>No HP Penanggung Jawab</th>
                                    <th>Tanggal Kejadian</th>
                                    <th>Nama Bencana</th>
                                    <th>Lokasi Bencana</th>
                                    <th>Korban</th>
                                    <th>Korban Jiwa</th>
                                    <th>Alamat Posko</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{$item->id_info_posko}}</td>
                                    <td>{{ $item->nama_penanggung_jawab }}</td>
                                    <td>{{ $item->no_hp_penanggung_jawab }}</td>
                                    <td>{{Carbon\Carbon::create($item->tanggal_kejadian)->format('d - m - Y')}}</td>
                                    <td>{{$item->jenis_bencana->nama_bencana}}</td>
                                    <td>{{$item->lokasi_bencana}}</td>
                                    <td>{{$item->jumlah_korban}}</td>
                                    <td>{{$item->jumlah_korban_jiwa}}</td>
                                    <td>{{$item->alamat_posko}}</td>
                                    <td>
                                        <a href="{{route('info-posko.edit', $item->id_info_posko)}}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                            @if ($item->is_active)
                                            <button class="btn btn-secondary btn-sm mt-1" disabled >
                                                Hapus
                                            </button>
                                            @else 
                                            <form action="{{route('info-posko.destroy',$item->id_info_posko)}}" method="post">
                                                @csrf 
                                                @method('DELETE')
                                                <button name="hapus" id="hapus" 
                                                class="btn  btn-danger btn-sm mt-1" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>
                                            </form>
                                            @endif
                                        <a href="{{ route('sub-posko.index',$item->id_info_posko) }}" class="btn btn-info btn-sm mt-1">Sub Posko</a>
                                        </td>
                                    </tr>              
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
        </div>
        <!-- /.container-fluid -->
        @endsection
        
        @push('addon-script')
        <script>
            $(document).ready(function() {
                $('#tableInfo').DataTable( {
                    "order": [[ 0, "desc" ]]
                } );
            } );    
        </script>    
        
        @endpush
        
        
        
        
        