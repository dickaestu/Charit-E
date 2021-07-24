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
                            <th>Status</th>
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
                            {{-- <td class="text-center">@if ($item->status_permintaan == 'BATAL')
                                <span class="text-danger">DITOLAK</span>
                                @endif
                                
                                @if ($item->status_permintaan == 'VERIFIED')
                                <span class="text-success">VERIFIED</span> 
                                @endif
                                
                                @if ($item->status_permintaan == 'PENDING')
                                <span class="text-secondary">PENDING</span> 
                                @endif
                            </td>
                            <td>{{$item->status_penerimaan ? 'Diterima':'Belum Diterima'}}</td> --}}
                            <td>
                                @if ($item->status_permintaan == 'BATAL')
                                <span>Ditolak</span>
                                @elseif ($item->status_permintaan == 'VERIFIED')
                                    @if ( $item->status_pengiriman == false && $item->status_penerimaan == false)
                                        <span>Terverifikasi</span> 
                                    @elseif( $item->status_pengiriman == true && $item->status_penerimaan == false)
                                        <span>Dikirim</span> 
                                    @elseif( $item->status_pengiriman == true && $item->status_penerimaan == true)
                                        <span>Diterima</span>
                                    @endif
                                @elseif ($item->status_permintaan == 'PENDING')
                                <span>Pending</span> 
                                @endif
                             </td>
                            <td>
                                <div class="d-flex align-items-center">   
                                    <a href="{{route('detail-permintaan-admin',$item->id_permintaan_barang)}}"
                                        class="btn btn-sm btn-success">Detail</a>
                                        
                                        @if ($item->status_permintaan == 'PENDING')
                                        <form class="ml-1 " action="{{route('verifikasi-permintaan', $item->id_permintaan_barang)}}" method="post">
                                            @csrf
                                            <button onclick="return confirm('Apakah anda yakin ingin verifikasi?');" type="submit" class="btn btn-sm btn-info">Verifikasi</button>
                                        </form>
                                        
                                            <button data-toggle="modal" data-target="#modalTambah" data-id={{ $item->id_permintaan_barang }} id="btnTolak" class="btn btn-sm btn-danger ml-1">Tolak</button>
                                        
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

    
<!--  Tambah Modal -->
    <div class="modal fade modalTambah" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Keterangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="" id="formTambah" method="POST">
                @csrf
                @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="keterangan_ditolak">Keterangan Ditolak</label>
                    <input type="text" name="keterangan_ditolak" required class="form-control @error('keterangan_ditolak') is-invalid @enderror" id="nama" placeholder="Masukkan Keterangan" value ="{{old('keterangan_ditolak')}}">
                    @error ('keterangan_ditolak')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
    
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
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

            $("#btnTolak").click( function(){
                const id = $(this).data('id')
                $('#formTambah').attr('action', `/admin/data-permintaan/tolak/${id}`);
            })
        } );
    </script>
    @endpush