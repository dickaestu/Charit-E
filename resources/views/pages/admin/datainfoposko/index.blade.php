@extends('layouts.admin.admin')
@section('title','Info Posko')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <div class="row ml-1 mb-3">
        <a href="{{ route('export-info-posko-admin') }}" class="btn btn-sm btn-primary ml-2 mt-2 shadow-sm">Cetak Semua</a>
        <button data-toggle="modal" data-target="#modalCetakTanggal"  class="btn btn-sm shadow-sm btn-success ml-2 mt-2">Cetak Berdasarkan Tanggal</button>
        <button data-toggle="modal" data-target="#modalCetakBencana" class="btn btn-sm shadow-sm btn-warning ml-2 mt-2">Cetak Berdasarkan Bencana</button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Info Posko</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableInfoPosko" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Posko</th>
                            <th>Alamat Posko</th>
                            <th>Tanggal Kejadian</th>
                            <th>Nama Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Jumlah Korban</th>
                            <th>Jumlah Korban Jiwa</th>
                            <th>Jumlah Sub Posko</th>
                            <th>Detail Sub Posko</th>

                        </tr>
                    </thead>
                    <tbody>
                       {{-- @forelse ($items as $item)
                            <tr>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->alamat_posko}}</td>
                                <td>{{Carbon\Carbon::create($item->tanggal_kejadian)->format('d-m-Y')}}</td>
                                <td>{{$item->jenis_bencana->nama_bencana}}</td>
                                <td>{{$item->lokasi_bencana}}</td>
                                <td>{{$item->jumlah_korban}}</td>
                                <td>{{$item->jumlah_korban_jiwa}}</td>
                                <td>{{$item->subposko->count()}}</td>
                                <td>
                                <a href="{{route('detail-data-subposko',$item->id_info_posko)}}" class="btn btn-sm btn-info btn-inline">Detail</a>
                                </td>
                            </tr>
                       @empty
                           <tr>
                               <td colspan="9" class="text-center">Data Kosong</td>
                           </tr>
                       
                       @endforelse --}}


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
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
            <form action="{{ route('export-info-posko-admin-bulan') }}" method="post">
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
            <form action="{{ route('print-info-posko-bencana-admin') }}" method="post">
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
            $('#tableInfoPosko').DataTable({
                "order": [[ 2, "desc" ]],
                processing:true,
                serverside:true,
                ajax:"{{ route('ajax.get.info.posko') }}",
                columns:[
                    {data:'nama_posko',name:'nama_posko'},
                    {data:'alamat_posko',name:'alamat_posko'}, 
                    {data:'tanggal_kejadian',name:'tanggal_kejadian'},
                    {data:'nama_bencana',name:'nama_bencana'},
                    {data:'lokasi_bencana',name:'lokasi_bencana'},
                    {data:'jumlah_korban',name:'jumlah_korban'},
                    {data:'jumlah_korban_jiwa',name:'jumlah_korban_jiwa'},
                    {data:'jumlah_sub_posko',name:'jumlah_sub_posko'},
                    {data:'detail_sub_posko',name:'detail_sub_posko'},
                ]
            });
        });
    </script>
@endpush