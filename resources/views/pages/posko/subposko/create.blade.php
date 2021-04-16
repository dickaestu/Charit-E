@extends('layouts.posko.posko')
@section('title','Tambah Sub Posko')



@section('content')

<!-- Begin Page Content -->
<div class="container-fluid ">
    <nav class="breadcrumb bg-transparent p-0">
        <a class="breadcrumb-item" href="{{ route('sub-posko.index',$id_info_posko) }}">Kembali</a>
        <span class="breadcrumb-item active">Tambah Sub Posko</span>
    </nav>
    <h3>Tambah Sub Posko</h3>
    
    
    <div class="card shadow">
        <div class="card-body">
            <form method="post" action="{{ route('sub-posko.store',$id_info_posko) }}">
                @csrf
                <div class="form-group">
                    <label for="nama_sub_posko">Nama Sub Posko</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" name="nama_sub_posko" required class="form-control @error('nama_sub_posko') is-invalid @enderror" id="nama_sub_posko"
                        Value="{{old('nama_sub_posko')}}"   placeholder="Masukkan Nama Sub Posko">
                    </div>
                    @error ('nama_sub_posko')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="nama_penanggung_jawab">Nama Penanggung Jawab</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" name="nama_penanggung_jawab" required class="form-control @error('nama_penanggung_jawab') is-invalid @enderror" id="nama_penanggung_jawab"
                        Value="{{old('nama_penanggung_jawab')}}"   placeholder="Masukkan Nama Penanggung Jawab">
                    </div>
                    @error ('nama_penanggung_jawab')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </form>
        </div>
    </div>
    
    
</div>
<!-- /.container-fluid -->
@endsection



