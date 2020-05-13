@extends('layouts.logistik.logistik')
@section('title','Laporan Uang Masuk')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <a href="{{ route('export-uang-masuk') }}" class="btn btn-primary mb-2">Cetak Semua</a>
    <form action="{{ route('export-uang-masuk-bulan') }}" method="post">
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
            <h6 class="m-0 font-weight-bold text-primary">Laporan Uang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableUang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Uang Masuk</th>
                            <th>ID Donasi</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama</th>
                            <th>Nominal</th>

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
        $('#tableUang').DataTable({
            processing:true,
            serverside:true,
            ajax:"{{ route('ajax.get.uang.masuk') }}",
            columns:[
                {data:'id_uang_masuk',name:'id_uang_masuk'},
                {data:'id_donasi',name:'id_donasi'}, 
                {data:'tanggal_masuk',name:'tanggal_masuk'},
                {data:'name',name:'name'},
                {data:'nominal',name:'nominal'},
            ]
        });
    });
</script>
@endpush