@extends('layouts.logistik.logistik')
@section('title','Data Barang Masuk')
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
            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableBarang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Barang Masuk</th>
                            <th>ID Donasi</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama</th>
                          
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>satuan</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                     @forelse ($items as $item)
                     <tr>
                        <td>{{$item->id_barang_masuk}}</td>
                        <td>{{$item->id_donasi}}</td>
                        <td>{{$item->tanggal_barang_masuk}}</td>
                        <td>{{$item->donasi->nama_donatur}}</td>
                        <td>{{$item->stokbarang->nama_barang}}</td>
                        <td>{{$item->jumlah}}</td>
                        <td>{{$item->stokbarang->satuan}}</td>
                      
                    </tr>
                     @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Kosong</td>    
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

<!-- Page level custom scripts -->
<script>
    $(document).ready(function() {
    $('#tableBarang').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );

</script>

@endpush