@extends('layouts.logistik.logistik')
@section('title','Data Pengiriman Logistik')

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
            <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePengirimanLogistik" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengiriman</th>
                            <th>ID Permintaan</th>
                            <th>Tanggal Pengiriman</th>
                            <th>ID Info Posko</th>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Aksi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->id_pengiriman_barang}}</td>
                            <td>{{$item->id_permintaan_barang}}</td>
                            <td>{{\Carbon\Carbon::create($item->tanggal_pengiriman)->format('d - m - Y')}}</td>
                            <td>{{$item->permintaanBarang->id_info_posko}}</td>
                            <td>{{$item->permintaanBarang->infoposko->user->name}}</td>
                            <td>{{$item->permintaanBarang->infoposko->alamat_posko}}</td>
                            <td>{{$item->permintaanBarang->infoposko->jenis_bencana->nama_bencana}}</td>
                            <td>{{$item->permintaanBarang->infoposko->lokasi_bencana}}</td>
                            
                            <td>
                                <div class="d-flex align-items-start">
                                    <a href="{{route('detail-pengiriman-logistik', $item->id_pengiriman_barang)}}"
                                        class="btn btn-sm btn-info mr-1">Detail Pengiriman
                                    </a>              
                                    @if (!$item->permintaanbarang->status_penerimaan)
                                    <form action="{{ route('data-pengiriman-logistik.destroy',$item->id_pengiriman_barang) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">
                                            Hapus
                                        </button>
                                    </form>
                                    @else 
                                    <button class="btn btn-secondary btn-sm" disabled>Hapus</button>
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
        $('#tablePengirimanLogistik').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
    } );    
</script>
@endpush