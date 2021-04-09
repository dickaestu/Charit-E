@extends('layouts.donasi.donasi')
@section('title','Konfirmasi Donasi')

@section('content')

<!-- Start breadcrumb-->
<div class="container">
    <div class="breadcrumb-area konfirmasi-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="donasi.html">Donasi</a></li>
                <li class="breadcrumb-item"><a href="detail-donasi.html">Detail Donasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Konfirmasi Donasi</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End breadcrumb -->

<!-- Start Konfirmasi Donasi Area -->

<div class="container my-5">
    
    <div class="row">
        <!-- start informasi bencana -->
        <div class="col-md-5">
            <div class="ketentuan-accordion mb-4 pl-0">
                <div class="section-title">
                    <h2>Ketentuan Donasi</h2>
                </div>
                <ul class="accordion">
                    <li class="accordion-item">
                        <a class="accordion-title " href="javascript:void(0)">
                            <i class="fa fa-arrow-right"></i>
                            Cara Donasi
                        </a>
                        <p class="accordion-content">1. Tulis ID Donasi Yang terlihat di kolom ID Donasi dan tulis nama penerima & no hp penerima ke kotak/dus/box donasi yang ingin anda
                            kirimkan <br>
                            2. Kirim Ke Alamat Yang Sudah Di Sediakan<br>
                            3. Upload Bukti foto barang yang anda ingin donasikan (ID Donasi harus terlihat)</p>
                        </li>
                        
                    </ul>
                </div>
                
                
                <ul class="list-group">
                    <li class="list-group-item">
                        Nama Penerima : {{ $aktivitas->info_posko->nama_penanggung_jawab }}
                    </li>
                    <li class="list-group-item">
                        No HP Penerima : {{ $aktivitas->info_posko->no_hp_penanggung_jawab }}
                    </li>
                    <li class="list-group-item">
                        Alamat Penerima : {{ $aktivitas->info_posko->alamat_posko }}
                    </li>
                </ul>
                
                
            </div>
            <!-- end Informasi bencana -->
            
            <!-- Start Informasi Anda -->
            <div class="col-md-7">
                <div class="section-title">
                    <h2>Informasi Anda</h2>
                </div>
                <form action="{{route('konfirmasi-donasi-create', $aktivitas->id_aktivitas_donasi)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_donasi">ID Donasi</label>
                        <input type="text" readonly class="form-control" id="id_donasi" placeholder="No ID Donasi Anda"
                        name="id_donasi" value="{{$id}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="nama_donatur">Nama Donatur</label>
                        <input readonly type="text" class="form-control" id="nama_donatur" placeholder="Masukkan Nama Donatur"
                        name="nama_donatur" value="{{Auth::user()->name}}">
                    </div>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" name="is_anonim" type="checkbox" value="1" id="is_anonim">
                        <label class="form-check-label" for="is_anonim">
                            Sembunyikan Nama Saya
                        </label>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input readonly value="{{Auth::user()->email}}" type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                    </div>
                    
                    
                    <div class="form-group mt-3">
                        <label for="foto_bukti">Upload Bukti</label>
                        <input required type="file" name="foto_bukti" class="form-control-file @error('foto_bukti') is-invalid @enderror" id="foto_bukti">
                        @error ('foto_bukti')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan_donasi" required class="form-control @error('keterangan_donasi') is-invalid @enderror" style="height: 100px">{{ old('keterangan_donasi') }}</textarea>
                        @error ('keterangan_donasi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    
                    
                    
                    
                    <button type="submit" class="default-btn btn-donasi btn-block d-block text-center mt-5"
                    style="height: 50px;" onclick="return confirm('Apakah data anda sudah benar?');">Konfirmasi</button>
                </form>
            </div>
            <!-- End Informasi Anda -->
        </div>
    </div>
    
    
    
    
    
    
    @endsection
    
    @push('addon-script')
    <script>
        function Checkradiobutton() {
            
            if (document.getElementById('r2').checked) {
                
                document.getElementById('nominal').disabled = false;
            } else {
                document.getElementById('nominal').disabled = true;
            }
            
            if (document.getElementById('r1').checked) {
                
                document.getElementById('keterangan').disabled = false;
            } else {
                document.getElementById('keterangan').disabled = true;
            }
        }
        
        
        
    </script>
    @endpush
    
    