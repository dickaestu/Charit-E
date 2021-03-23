@extends('layouts.admin.admin')
@section('title','Data Aktivitas')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>    
    @endif
    @if (session('dihapus'))
    <div class="alert alert-success" role="alert">
        {{session('dihapus')}}
      </div>    
    @endif
    @if (session('edit'))
    <div class="alert alert-success" role="alert">
        {{session('edit')}}
      </div>    
    @endif
    <!-- Page Heading -->

    <a href="{{route('data-aktivitas.create')}}" class="btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Aktivitas Donasi</a>

    <!-- DataTales Example -->
    <div class=" card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Aktivitas Donasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableAkt" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Aktivitas Donasi</th>
                            <th>Nama Posko</th>
                            <th>Nama Bencana</th>
                            <th>Lokasi Bencana</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($items as $item)
                       <tr>
                        <td>{{$item->id_aktivitas_donasi}}</td>
                        <td>{{$item->info_posko->user->name}}</td>
                        <td>{{$item->info_posko->jenis_bencana->nama_bencana}}</td>
                        <td>{{$item->info_posko->lokasi_bencana}}</td>
                        <td>{{$item->keterangan_aktivitas}}</td>
                        <td><a href="{{Storage::url($item->foto_aktivitas)}}" target="_blank" class="btn btn-sm btn-info">Lihat Foto</a></td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm mb-1">Aktifkan Donasi</a>
                            <a  href="{{route('data-aktivitas.edit', $item->id_aktivitas_donasi)}}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{route('data-aktivitas.destroy',$item->id_aktivitas_donasi)}}" method="post">
                                @csrf
                                @method('delete')
                                    <button name="hapus" id="hapus"
                                    class="btn btn-danger btn-sm mt-1" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                       
                       @endforeach


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
    $(document).ready(function() {
        $('#tableAkt').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
    } );
    </script>
@endpush