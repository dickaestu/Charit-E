@extends('layouts.posko.posko')
@section('title','Info Posko')

@section('content')
   
    <!-- Begin Page Content -->
    <div class="container-fluid ">
        <h3>Info Posko</h3>
        <div class="card shadow">
            <div class="card-body">
                 <form method="post" action="{{route('info-posko.store')}}">
                     @csrf
                     <div class="form-group">
                        <label for="nama_penanggung_jawab">Nama Penanggung Jawab</label>
                         <input type="text" class="form-control @error('nama_penanggung_jawab') is-invalid @enderror" name="nama_penanggung_jawab" placeholder="Masukkan Nama Penanggung Jawab" required value="{{old('nama_penanggung_jawab')}}">
                         @error ('nama_penanggung_jawab')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                    </div>
                     <div class="form-group">
                        <label for="no_hp_penanggung_jawab">Nomor Handphone Penanggung Jawab</label>
                         <input type="number" class="form-control @error('no_hp_penanggung_jawab') is-invalid @enderror" name="no_hp_penanggung_jawab" placeholder="Masukkan No hp Penanggung Jawab" required value="{{old('no_hp_penanggung_jawab')}}">
                         @error ('no_hp_penanggung_jawab')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                    </div>
                     <div class="form-group">
                        <label for="tanggal_kejadian">Tanggal Kejadian</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="date" required name="tanggal_kejadian" class="form-control @error('tanggal_kejadian') is-invalid @enderror" id="tanggal_kejadian"
                                    placeholder="Tanggal Kejadian">
                            </div>
                            @error ('tanggal_kejadian')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_posko">Alamat Posko</label>
                         <input type="text" class="form-control @error('alamat_posko') is-invalid @enderror" name="alamat_posko" placeholder="Masukkan Alamat Posko" required Value="{{old('alamat_posko')}}">
                         @error ('alamat_posko')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_bencana">Jenis Bencana</label>
                        <select name="id_jenis_bencana" required class="form-control @error('id_jenis_bencana') is-invalid @enderror">
                            <option value="">Pilih Jenis Bencana</option>
                             @foreach ($jenis_bencana as $bencana)
                        <option value="{{$bencana->id_jenis_bencana}}"> {{$bencana->nama_bencana}}</option>
                             @endforeach
                        </select>
                        @error ('id_jenis_bencana')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi_bencana">Lokasi Bencana</label>
                         <input type="text" class="form-control @error('lokasi_bencana') is-invalid @enderror" required name="lokasi_bencana" placeholder="Masukkan Lokasi Bencana" Value="{{old('lokasi_bencana')}}">
                         @error ('lokasi_bencana')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_korban">Jumlah Korban</label>
                         <input type="number" min="0" class="form-control @error('jumlah_korban') is-invalid @enderror" required name="jumlah_korban" placeholder="Masukkan Jumlah Korban" Value="{{old('jumlah_korban')}}">
                         @error ('jumlah_korban')
                         <div class="invalid-feedback">
                             {{$message}}
                         </div>
                         @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_korban_jiwa">Jumlah Korban Jiwa</label>
                         <input type="number" min="0" class="form-control @error('jumlah_korban_jiwa') is-invalid @enderror" required name="jumlah_korban_jiwa" placeholder="Masukkan Jumlah Korban Jiwa" Value="{{old('jumlah_korban_jiwa')}}">
                         @error ('jumlah_korban_jiwa')
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



