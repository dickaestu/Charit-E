@extends('layouts.logistik.logistik')
@section('title','Data Stok Barang')
@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>       
    @endif
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
    
    <button data-toggle="modal" data-target="#modalTambah" class="btn btn-primary mb-3" name="tambah" id="tambah"> <i class="fa fa-plus"> Tambah Barang</i></button>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableStokBarang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi Barang</th>
                                <th>Quantity</th>
                                
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{$item->id_stok_barang}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->deskripsi_barang}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->satuan}}</td>
                                <td>
                                    <a  href="{{route('data-stok-barang.edit', $item->id_stok_barang)}}"
                                        class="btn btn-warning btn-sm">Edit</a> 
                                        {{-- @if ($item->quantity > 0)
                                            <button name="hapus" id="hapus" disabled
                                            class="btn btn-secondary btn-sm">Hapus</button>
                                            @else --}}
                                            
                                            <form class="d-inline" action="{{route('data-stok-barang.destroy',$item->id_stok_barang)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button name="hapus" id="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data?');"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                            {{-- @endif --}}
                                            
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    </tr>
                                    @endforelse
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->
            
            <!--  Tambah Modal -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('data-stok-barang.store')}}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_barang">Nama</label>
                                    <input type="text" name="nama_barang" required class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Masukkan Nama Barang">
                                    @error ('nama_barang')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="deskripsi_barang">Deskripsi Barang</label>
                                    <input type="text" name="deskripsi_barang" required class="form-control @error('deskripsi_barang') is-invalid @enderror" id="deskripsi_barang" placeholder="Masukkan Deskripsi Barang">
                                    @error ('deskripsi_barang')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select name="satuan" required class="form-control @error('satuan') is-invalid @enderror">
                                        <option value="">Pilih Satuan</option>
                                        <option value="dus">dus</option>
                                        <option value="sak">sak</option>
                                        <option value="buah">buah</option>
                                        <option value="unit">unit</option>
                                        <option value="pcs">pcs</option>
                                        <option value="lembar">lembar</option>
                                    </select>
                                    @error ('satuan')
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
            
            <script>
                $(document).ready(function () {
                    $("#tableStokBarang").DataTable();
                });
            </script>
            @endpush