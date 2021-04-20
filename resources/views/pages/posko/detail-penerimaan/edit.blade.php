@extends('layouts.posko.posko')
@section('title','Edit Detail Penerimaan')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <nav class="breadcrumb bg-transparent">
        <a class="breadcrumb-item" href="{{ route('detail-penerimaan-posko',$item->penerimaanBarang->pengirimanBarang->id_permintaan_barang) }}">Kembali</a>
        <span class="breadcrumb-item active">Edit Detail Penerimaan</span>
    </nav>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Detail Penerimaan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('detail-penerimaan-posko.update',$item->id_detail_penerimaan_barang) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <select name="id_stok_barang" required class="form-control @error('id_stok_barang') is-invalid @enderror">
                        @foreach ($stokBarang as $barang)
                        <option {{ $item->id_stok_barang == $barang->id_stok_barang ? 'selected': '' }} 
                            value="{{ $barang->id_stok_barang }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error ('id_stok_barang')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" min="1" name="jumlah" required class="form-control @error('jumlah') is-invalid @enderror" value="{{ $item->jumlah }}">
                        @error ('jumlah')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->
    
    @endsection
    