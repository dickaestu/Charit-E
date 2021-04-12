@extends('layouts.donasi.donasi')
@section('title','Detail Donatur')

@section('content')




<!-- Start Page Title Area -->
<div style=" background-image: url({{Storage::url($item->foto_aktivitas)}});" class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Detail Donatur Bencana {{$item->info_posko->jenis_bencana->nama_bencana}} Di {{$item->info_posko->lokasi_bencana}}</h2>
            <ul>
                <li>
                    <a href="{{route('home')}}">
                        Home
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li>
                <li>Detail Donatur</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->


<!-- Start Active Campaign Area -->
<section class="active-campaing-area">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="section-title mt-2">
                    <h6>Daftar Donasi Yang Sudah Di Terima Posko</h6>
                    <div class="card px-2 py-4 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-bordered table_penerimaan"  width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal Donasi</th>
                                        <th>Tanggal Terima</th>
                                        <th>Nama Donatur</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    <tr>
                                        <td>05 April 2021</td>
                                        <td>08 April 2021</td>
                                        <td>Ayu</td>
                                        <td>baju dan obat obatan</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="section-title mt-2">
                    <h6>Daftar Donasi Yang Belum Di Terima Posko</h6>
                    <div class="card px-2 py-4 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-bordered table_penerimaan"  width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal Donasi</th>
                                        <th>Nama Donatur</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    @foreach ($donasiNotVerif as $item)
                                    <tr>
                                        <td>{{ $item->tanggal_donasi }}</td>
                                        <td>{{ $item->is_anonim ? 'Anonim' : $item->user->name }}</td>
                                        <td>{{ $item->keterangan_donasi }}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- <div class="row">
            <div class="col">
                <div class="section-title mt-2">
                    <h2>Daftar Barang Yang Tersedia Di Posko</h2>
                    <div class="card px-2 py-4 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-bordered table_penerimaan"  width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                    <tr>
                                        <td>P3k</td>
                                        <td>20</td>
                                        <td>box</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        
        
    </div>
    
    <div class=" shape shape-1">
        <img src="{{url('donasi_assets/assets/img/shape/1.png')}}" alt="Shape">
    </div>
</section>
<!-- End Active Campaign Area -->




@endsection

