@extends('layouts.logistik.logistik')
@section('title','Laporan Pengeluaran')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <a href="{{ route('export-pengeluaran-uang') }}" class="btn btn-primary mb-2">Cetak Semua</a>
    <form action="{{ route('export-pengeluaran-uang-bulan') }}" method="post">
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
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pengeluaran Uang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tablePengeluaran" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengeluaran</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Keterangan Pengeluaran</th>
                            <th>Total Pengeluaran</th>
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

    <script>
        $(document).ready(function(){
            $('#tablePengeluaran').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.pengeluaran') }}",
                columns:[
                    {data:'id_pengeluaran_uang',name:'id_pengeluaran_uang'},
                    {data:'tanggal_pengeluaran',name:'tanggal_pengeluaran'},
                    {data:'keterangan_pengeluaran',name:'keterangan_pengeluaran'},
                    {data:'total_pengeluaran',name:'total_pengeluaran'},
                    {data:'detail_pengeluaran',name:'detail_pengeluaran'},
                ]
            });
        });
    </script>
@endpush