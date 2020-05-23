@extends('layouts.logistik.logistik')
@section('title','Data Uang Donasi')
@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Uang Masuk</h6>
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
                        @forelse ($items as $item)
                        <tr>
                            <td>{{$item->id_uang_masuk}}</td>
                            <td>{{$item->id_donasi}}</td>
                            <td>{{Carbon\Carbon::create($item->tanggal_masuk)->format('d - m - Y')}}</td>
                            <td>{{$item->donasi->nama_donatur}}</td>
                            <td>@currency($item->nominal)</td>
                        </tr>
                        @empty
                        
                        <tr>
                            <td class="text-center" colspan="5">Data Kosong</td>
                        </tr>

                        @endforelse


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
    $(document).ready(function() {
    $('#tableUang').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );

</script>

@endpush