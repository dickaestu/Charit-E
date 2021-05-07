@extends('layouts.logistik.logistik')
@section('title','Laporan Pengiriman')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <a target="_blank" href="{{ route('export-pengiriman-logistik') }}" class="btn btn-primary mb-2">Cetak Semua</a>
    <form target="_blank" action="{{ route('export-pengiriman-logistik-bulan') }}" method="post">
        @csrf
        <div class="col col-md-5">
            <div class="card mb-2">
                <div class="card-body">
                    <label for="from">Dari Tanggal :</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input required style="cursor: pointer;" type="date" class="form-control datepicker" name="from" id="from"
                            placeholder="Pilih Tanggal">
                    </div>
    
                    <label for="to">Sampai Tanggal :</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input required style="cursor: pointer;" type="date" class="form-control datepicker" name="to" id="to"
                            placeholder="Pilih Tanggal">
                    </div>
                    <button type="submit" class="btn btn-primary btn-secondary">Cetak</button>
                </div>
            </div>
        </div>
    </form>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pengiriman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePengiriman" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengiriman</th>
                            <th>ID Permintaan</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Bencana</th>
                            <th>Keterangan Pengiriman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id_pengiriman_barang }}</td>
                                <td>{{ $item->id_permintaan_barang }}</td>
                                <td>{{ Carbon\Carbon::create($item->tanggal_pengiriman)->format('d-M-Y') }}</td>
                                <td>{{ $item->permintaanbarang->infoposko->user->name }}</td>
                                <td>{{ $item->permintaanbarang->infoposko->alamat_posko }}</td>
                                <td>{{ $item->permintaanbarang->infoposko->jenis_bencana->nama_bencana }}</td>
                                <td>{{ $item->keterangan_pengiriman }}</td>
                                <td><a target="_blank" href="{{ route('print-detail-pengiriman',$item->id_pengiriman_barang) }}" class="btn btn-sm btn-info">Print Detail</a></td>
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

    <script>
        $(document).ready(function(){
            $('#tablePengiriman').DataTable({
                
            });
        });
    </script>
@endpush