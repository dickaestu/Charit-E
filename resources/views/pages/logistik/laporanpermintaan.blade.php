@extends('layouts.logistik.logistik')
@section('title','Laporan Permintaan')
@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <a href="{{ route('export-permintaan-logistik') }}" class="btn btn-primary mb-2">Cetak Semua</a>
    <form action="{{ route('export-permintaan-logistik-bulan') }}" method="post">
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
            <h6 class="m-0 font-weight-bold text-primary">Laporan Permintaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePermintaan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Permintaan</th>
                            <th>Tanggal Permintaan</th>
                            <th>Lokasi Bencana</th>
                            <th>Status Permintaan</th>
                            <th>Status Penerimaan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                    
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

 <!-- Page level custom scripts -->
 <script>
    $(document).ready(function(){
        $('#tablePermintaan').DataTable({
            processing:true,
            serverside:true,
            ajax:"{{ route('ajax.get.permintaan') }}",
            columns:[
              
                {data:'id_permintaan_barang',name:'id_permintaan_barang'},
                {data:'tanggal_permintaan',name:'tanggal_permintaan'},
                {data:'infoposko.lokasi_bencana',name:'infoposko.lokasi_bencana'},
                {data:'status_permintaan',name:'id_permintaan_barang'},
                {data:'status_penerimaan',name:'status_penerimaan'},
                {data:'keterangan_permintaan',name:'keterangan_permintaan'},
                {data:'detail_permintaan',name:'detail_permintaan'},
                
            ]
        });
    });
</script>
@endpush
 