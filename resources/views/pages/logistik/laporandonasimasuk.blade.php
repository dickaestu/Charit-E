@extends('layouts.logistik.logistik')
@section('title','Laporan Donasi Masuk')
@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">
    <div class="row ml-1 mb-3">
        <a href="{{ route('export-donasi-masuk') }}" class="btn btn-sm btn-primary ml-2 mt-2 shadow-sm">Cetak Semua</a>
        <button data-toggle="modal" data-target="#modalCetakTanggal"  class="btn btn-sm shadow-sm btn-success ml-2 mt-2">Cetak Berdasarkan Tanggal</button>
        <button data-toggle="modal" data-target="#modalCetakBencana" class="btn btn-sm shadow-sm btn-warning ml-2 mt-2">Cetak Berdasarkan Bencana</button>
    </div>
    <!-- DataTales Example -->
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Donasi Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableDonasi" width="100%" cellspacing="0">
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
<!-- /.container-fluid -->



@endsection
     

<!-- Modal -->
<div class="modal fade" id="modalCetakTanggal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Berdasarkan Tanggal Tertentu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('export-donasi-masuk-bulan') }}" method="post">
                @csrf
            
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
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </div>
              
            </form>
        </div>
     
      </div>
    </div>
  </div>


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
            <form action="{{ route('print-donasi-masuk-bencana') }}" method="post">
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
            $('#tableDonasi').DataTable({
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.donasi.masuk') }}",
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
 