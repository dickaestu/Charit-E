@extends('layouts.admin.admin')
@section('title','Permintaan Logistik')

@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>    
    @endif
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Permintaan Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePermintaan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Permintaan</th>
                            <th>Tanggal Permintaan</th>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Status Verifikasi</th>
                            <th>Status Penerimaan</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->id_permintaan_barang}}</td>
                            <td>{{\Carbon\Carbon::create($item->tanggal_permintaan)->format('d - m - Y')}}</td>
                            <td>{{$item->infoposko->user->name}}</td>
                            <td>{{$item->infoposko->alamat_posko}}</td>
                            <td class="text-center">@if ($item->status_permintaan == 'BATAL')
                                <span class="text-danger">DITOLAK</span>
                                @endif
                                
                                @if ($item->status_permintaan == 'VERIFIED')
                                <span class="text-success">VERIFIED</span> 
                                @endif
                                
                                @if ($item->status_permintaan == 'PENDING')
                                <span class="text-secondary">PENDING</span> 
                                @endif
                            </td>
                            <td>{{$item->status_penerimaan ? 'Diterima':'Belum Diterima'}}</td>
                            
                            <td>
                                <div class="d-flex align-items-center">   
                                    <a href="{{route('detail-permintaan-admin',$item->id_permintaan_barang)}}"
                                        class="btn btn-sm btn-success">Detail</a>
                                        
                                        @if ($item->status_permintaan == 'PENDING')
                                        <form class="ml-1 " action="{{route('verifikasi-permintaan', $item->id_permintaan_barang)}}" method="post">
                                            @csrf
                                            <button onclick="return confirm('Apakah anda yakin ingin verifikasi?');" type="submit" class="btn btn-sm btn-info">Verifikasi</button>
                                        </form>
                                        
                                        <form class="ml-1 " action="{{route('tolak-permintaan', $item->id_permintaan_barang)}}" method="post">
                                            @csrf
                                            <button onclick="return confirm('Apakah anda yakin ingin tolak permintaan ini?');" class="btn btn-sm btn-danger">Tolak</button>
                                        </form>  
                                        
                                        @else
                                         <button disabled  class="btn btn-sm ml-1 btn-secondary">Verifikasi</button> 
                                        
                                        
                                          <button disabled class="btn btn-sm ml-1 btn-secondary">Tolak</button>
                                        
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
    @endsection
    
    
    
    
    @push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#tablePermintaan').DataTable( {
                "order": [[ 0, false ]]
            } );
        } );
    </script>
    @endpush