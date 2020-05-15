@extends('layouts.admin.admin')
@section('title','Laporan Donasi Masuk')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    {{-- <a href="{{ route('export-donasi-masuk-admin') }}" class="btn btn-primary mb-2">Cetak Semua</a>
    <form action="{{ route('export-donasi-masuk-admin-bulan') }}" method="post">
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
            <h6 class="m-0 font-weight-bold text-primary">Laporan Donasi Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="tableDonasi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Donasi</th>
                            <th>Tanggal Donasi</th>
                            <th>Nama Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Nama Donatur</th>
                            <th>Status Verifikasi</th>
                            <th>Jenis Donasi</th>
                            <th>keterangan</th>

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
    <script>
        $(document).ready(function(){
            $('#tableDonasi').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.data.donasi') }}",
                columns:[
                  
                    {data:'id_donasi',name:'id_donasi'},
                    {data:'tanggal_donasi',name:'tanggal_donasi'}, 
                    {data:'nama_bencana',name:'nama_bencana'}, 
                    {data:'lokasi_bencana',name:'lokasi_bencana'},
                    {data:'nama_donatur',name:'nama_donatur'},
                    {data:'status_verifikasi',name:'status_verifikasi'},
                    {data:'jenis_donasi',name:'jenis_donasi'},
                    {data:'keterangan_donasi',name:'keterangan_donasi'},
                ]
            });
        });
    </script>
@endpush