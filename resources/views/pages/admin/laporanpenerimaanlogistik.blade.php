@extends('layouts.admin.admin')
@section('title','Laporan Penerimaan Logistik')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    {{-- <a href="{{ route('export-penerimaan-logistik-admin') }}" class="btn btn-primary mb-2">Cetak Semua</a>
    <form action="{{ route('export-penerimaan-logistik-admin-bulan') }}" method="post">
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
    </form> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Penerimaan Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePenerimaan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Penerimaan</th>
                            <th>ID Pengiriman</th>
                            <th>Tanggal Penerimaan</th>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Bencana</th>
                            <th>Keterangan Penerimaan</th>
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
@endsection


@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#tablePenerimaan').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.penerimaan.logistik') }}",
                columns:[
                    {data:'id_penerimaan_barang',name:'id_penerimaan_barang'},
                    {data:'id_pengiriman_barang',name:'id_pengiriman_barang'}, 
                    {data:'tanggal_penerimaan',name:'tanggal_penerimaan'},
                    {data:'name',name:'name'},
                    {data:'alamat_posko',name:'alamat_posko'},
                    {data:'nama_bencana',name:'nama_bencana'},
                    {data:'keterangan_penerimaan',name:'keterangan_penerimaan'},
                    {data:'detail_penerimaan',name:'detail_penerimaan'},
                ]
            });
        });
    </script>
@endpush