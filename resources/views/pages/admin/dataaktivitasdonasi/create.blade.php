@extends('layouts.admin.admin')
@section('title','Tambah Aktivitas')



@section('content')
   
    <!-- Begin Page Content -->
    <div class="container-fluid ">
        <h3>Tambah Aktivitas Donasi</h3>
      

        <div class="card shadow">
            <div class="card-body">
                 <form method="post" action="{{route('data-aktivitas.store')}}" enctype="multipart/form-data">
                     @csrf
                    
                    <div class="form-group">
                        <label for="id_info_posko">Posko</label>
                        <select name="id_info_posko" required class="form-control @error('id_info_posko') is-invalid @enderror">
                            <option value="">Pilih Posko</option>
                             @foreach ($info_posko as $posko)
                        <option value="{{$posko->id_info_posko}}">Nama Posko: {{$posko->user->name}}, - Bencana : {{$posko->jenis_bencana->nama_bencana}}, - Lokasi : {{$posko->lokasi_bencana}} </option>
                             @endforeach
                        </select>
                        @error ('id_info_posko')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto_aktivitas">Foto Aktivitas</label>
                        <input type="file" required name="foto_aktivitas" class="form-control @error('foto_aktivitas') is-invalid @enderror" placeholder="foto_aktivitas">
                        @error ('foto_aktivitas')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan_aktivitas">Keterangan</label>
                        <textarea required name="keterangan_aktivitas" class="form-control @error('keterangan_aktivitas') is-invalid @enderror" id="keterangan_aktivitas" rows="3"></textarea>
                        @error ('keterangan_aktivitas')
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



