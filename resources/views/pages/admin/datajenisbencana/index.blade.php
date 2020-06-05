@extends('layouts.admin.admin')
@section('title','Data Jenis Bencana')

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

    
    <!-- Page Heading -->

    <button data-toggle="modal" data-target="#modalTambah" class="btn btn-success mb-3" name="tambah" id="tambah">Tambah</button>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="100">ID Bencana</th>
                            <th>Nama Bencana</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{$item->id_jenis_bencana}}</td>
                            <td>{{$item->nama_bencana}}</td>
                            <td>

                            <form action="{{route('data-jenis-bencana.destroy',$item->id_jenis_bencana)}}" method="post">
                                @csrf
                                @method('delete')
                                    <button name="hapus" id="hapus"
                                    class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>
                                </form>
                                
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!--  Tambah Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Bencana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{route('data-jenis-bencana.store')}}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="nama_bencana">Nama</label>
                <input type="text" name="nama_bencana" class="form-control @error('nama_bencana') is-invalid @enderror" id="nama_bencana" placeholder="Masukkan Nama Bencana" value ="{{old('nama_bencana')}}">
                @error ('nama_bencana')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
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
@endpush