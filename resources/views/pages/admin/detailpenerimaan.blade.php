@extends('layouts.admin.admin')
@section('title','Detail Penerimaan Logistik')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<nav class="ml-3" aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent">
      <li class="breadcrumb-item"><a style="text-decoration: none"  href="{{ route('laporan-penerimaan') }}">Data Penerimaan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Penerimaan</li>
    </ol>
  </nav>
<div class="container-fluid">
  
    <table cellpadding="8" class="table-responsive table-borderless mb-3">
        <tr>
            <th>Lokasi Bencana  </th>
            <td>:</td>
            <td>{{$info->pengirimanbarang->permintaanbarang->infoposko->lokasi_bencana}}</td>
        </tr>
        <tr>
            <th>Nama Bencana  </th>
            <td>:</td>
            <td>{{$info->pengirimanbarang->permintaanbarang->infoposko->jenis_bencana->nama_bencana}}</td>
        </tr>
        <tr>
            <th>Jumlah Korban  </th>
            <td>:</td>
            <td>{{$info->pengirimanbarang->permintaanbarang->infoposko->jumlah_korban}} Orang</td>
        </tr>

        <tr>
            <th>Jumlah Korban Jiwa </th>
            <td>:</td>
            <td>{{$info->pengirimanbarang->permintaanbarang->infoposko->jumlah_korban_jiwa}} Orang</td>
        </tr>
        <tr>
            <th>Keterangan Pengiriman </th>
            <td>:</td>
            <td>{{$info->keterangan_penerimaan}}</td>
        </tr>
    </table>

    <a href="{{ route('print-detail-penerimaan-admin',$info->id_penerimaan_barang) }}" class="btn btn-sm btn-primary mb-2 shadow-sm">Cetak</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Penerimaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>

                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($items as $item )    
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->stokbarang->nama_barang}} / {{$item->stokbarang->satuan}}</td>
                                <td>{{$item->jumlah_penerimaan}}</td>        
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
    <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>
@endpush