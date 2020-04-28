@extends('layouts.posko.posko')
@section('title','Tambah Sub Posko')



@section('content')
   
    <!-- Begin Page Content -->
    <div class="container-fluid ">
        <h3>Tambah Sub Posko</h3>
       

        <div class="card shadow">
            <div class="card-body">
                <form class="my-3" action="{{route('sub-posko.update', $item->id_sub_posko)}}" method="POST">
                    @method('PUT')
                    @csrf

                     <div class="form-group">
                        <label for="id_info_posko">Pilih Bencana dan Tanggal Kejadian</label>
                        <select name="id_info_posko" required class="form-control">
                            <option value="{{$item->id_info_posko}}">{{$item->info_posko->jenis_bencana->nama_bencana}}, Lokasi : {{$item->info_posko->lokasi_bencana}} Tanggal: {{$item->info_posko->tanggal_kejadian}}</option>
                             @foreach ($info_posko as $posko)
                        <option value="{{$posko->id_info_posko}}"> {{$posko->jenis_bencana->nama_bencana}}, Lokasi : {{$posko->lokasi_bencana}} Tanggal: {{$posko->tanggal_kejadian}}</option>
                             @endforeach
                        </select>
                    </div>

                     <div class="form-group">
                        <label for="nama_sub_posko">Nama Sub Posko</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" name="nama_sub_posko" required class="form-control @error('nama_sub_posko') is-invalid @enderror" id="nama_sub_posko"
                                Value="{{($item->nama_sub_posko)}}"   placeholder="Masukkan Nama Sub Posko">
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
                                Value="{{$item->nama_penanggung_jawab}}"   placeholder="Masukkan Nama Penanggung Jawab">
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



