@extends('layouts.logistik.logistik')
@section('title','Edit Data Stok Barang')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid ">
    <h3>Edit Data Stok Barang {{$item->nama_barang}}</h3>
    <nav class="breadcrumb bg-transparent">
      <a class="breadcrumb-item" href="{{ route('data-stok-barang.index') }}">Kembali</a>
      <span class="breadcrumb-item active">Edit Data Stok Barang</span>
    </nav>

    <div class="col-10 offset-1 mt-4 border rounded">
    <form class="my-3" action="{{route('data-stok-barang.update', $item->id_stok_barang)}}" method="POST">
          @method('PUT')
          @csrf
        <div class="form-group">
            <label for="nama_barang">Nama</label>
            <input type="text" name="nama_barang" class="form-control  @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Masukkan Nama" value ="{{$item->nama_barang}}">
            @error ('nama_barang')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi_barang">Deskripsi Barang</label>
            <input type="text" name="deskripsi_barang" class="form-control  @error('deskripsi_barang') is-invalid @enderror" id="deskripsi_barang" placeholder="Masukkan Nama" value ="{{$item->deskripsi_barang}}">
            @error ('deskripsi_barang')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="form-group">
            <label for="satuan">Pilih Satuan</label>
            <select class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan">
            <option  value="dus" @if ($item->satuan == 'dus') selected @endif>dus</option>
            <option  value="sak" @if ($item->satuan == 'sak') selected @endif>sak</option>
            <option  value="buah" @if ($item->satuan == 'buah') selected @endif>buah</option>
            <option  value="unit" @if ($item->satuan == 'unit') selected @endif>unit</option>
            <option  value="pcs" @if ($item->satuan == 'pcs') selected @endif>pcs</option>
            <option  value="lembar" @if ($item->satuan == 'lembar') selected @endif>lembar</option>
            </select>
            @error ('satuan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
        </div>

        <div class="col col-md-6 offset-md-3 mt-4">
          <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin ingin mengubah data?');" >Ubah</button>
        </div>
      </form>

    </div>


  </div>
  <!-- /.container-fluid -->


  

@endsection

@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>

   
@endpush


