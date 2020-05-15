@extends('layouts.admin.admin')
@section('title','Laporan Aktivitas Donasi')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <div class="row ml-1 mb-3">
        <a href="{{ route('export-aktivitas-donasi-admin') }}" class="btn btn-sm btn-primary ml-2 mt-2 shadow-sm">Cetak Semua</a>
      
        <button data-toggle="modal" data-target="#modalCetakBencana" class="btn btn-sm shadow-sm btn-primary ml-2 mt-2">Cetak Berdasarkan Bencana</button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Aktivitas Donasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="tableAktivitas" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Aktivitas Donasi</th>
                            <th>Tanggal Kejadian</th>
                            <th>Nama Posko</th>
                            <th>Nama Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Jumlah Donasi Uang</th>
                            <th>Jumlah Donasi Barang</th>
                            <th>Total Donasi</th>

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




  <!-- Modal -->
<div class="modal fade" id="modalCetakBencana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Berdasarkan Bencana Tertentu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('print-aktivitas-donasi-bencana-admin') }}" method="post">
                @csrf
            
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_jenis_bencana">Pilih Jenis Bencana</label>
                                <select class="form-control" name="id_jenis_bencana" id="id_jenis_bencana">
                                 @foreach ($jenis_bencana as $item)
                                 <option value="{{ $item->id_jenis_bencana }}">{{ $item->nama_bencana }}</option>
                                 @endforeach
                                </select>
                              </div>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </div>
              
            </form>
        </div>
     
      </div>
    </div>
  </div>

@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function(){
            $('#tableAktivitas').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.data.aktivitas.donasi') }}",
                columns:[
                  
                    {data:'id_aktivitas_donasi',name:'id_aktivitas_donasi'},
                    {data:'tanggal_kejadian',name:'tanggal_kejadian'}, 
                    {data:'name',name:'name'}, 
                    {data:'nama_bencana',name:'nama_bencana'}, 
                    {data:'lokasi_bencana',name:'lokasi_bencana'}, 
                    {data:'donasi_uang',name:'donasi_uang'}, 
                    {data:'donasi_barang',name:'donasi_barang'}, 
                    {data:'total_donasi',name:'total_donasi'}, 
                ]
            });
        });
    </script>
@endpush