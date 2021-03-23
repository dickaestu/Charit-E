@extends('layouts.posko.posko')
@section('title','Data Permintaan')

@section('content')
  
      <!-- Begin Page Content -->
      <div class="container-fluid ">

        @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
          </div>    
        @endif

        @if (session('penerimaan'))
        <div class="alert alert-success" role="alert">
            {{session('penerimaan')}}
          </div>    
        @endif

        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
          </div>    
        @endif

        <a href="{{route('tambah-permintaan')}}" class="btn btn-sm btn-primary shadow-sm mb-4">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Permintaan</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Permintaan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Permintaan</th>
                                <th>Tanggal Permintaan</th>
                                <th>Bencana - Lokasi Bencana</th>
                                <th>Status Permintaan</th>
                                <th>Status Pengiriman</th>
                                <th>Aksi</th>
                                <th width="20">Laporan Penerimaan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($infoposko as $posko )
                            @foreach ($items as $item )
                                @if ($posko->id_info_posko == $item->id_info_posko)
                                    
                                <tr>
                                    <td>{{$item->id_permintaan_barang}}</td>
                                    <td>{{\Carbon\Carbon::create($item->tanggal_permintaan)->format('d - m - Y')}}</td>
                                    <td>{{$item->infoposko->jenis_bencana->nama_bencana}} - {{$item->infoposko->lokasi_bencana}}</td>
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
                                    <td>{{$item->status_pengiriman ? 'DIKIRIM' : 'BELUM DIKIRIM'}} </td>

                                    <td>
                                    
                                    <a href="{{route('detail-permintaan', $item->id_permintaan_barang)}}"
                                            class="btn btn-sm btn-success mb-1">Detail</a>
        
        
                                    @if ($item->status_permintaan == 'VERIFIED')
                                  
                                        <button disabled name="hapus" id="hapus" 
                                        class="btn btn-secondary btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>       
                                    @else
                                    <form class="d-inline" action="{{route('hapus-data-permintaan',$item->id_permintaan_barang)}}" method="post">
                                        @csrf
                                        <button name="hapus" id="hapus" 
                                        class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>           
                                    </form>
                                    @endif

                                    <td>
                                        @if ($item->status_penerimaan == true )
                                      <a href="{{route('detail-penerimaan-posko',$item->id_permintaan_barang)}}" class="btn btn-sm btn-info px-1">Detail Laporan</a></td>
                                        @elseif ($item->status_permintaan == 'VERIFIED')
                                        <a href="{{route('tambah-laporan-penerimaan',$item->id_permintaan_barang)}}" class="btn btn-sm btn-warning">Buat Laporan</a></td>
                                        @else
                                        <a href="" class="btn btn-sm btn-secondary disabled">Buat Laporan</a></td>
                                        @endif

                                    
                                </tr>
                                @endif
                            @endforeach
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
            "order": [[ 0, "desc" ]]
        } );
    } );    
    </script>    

@endpush