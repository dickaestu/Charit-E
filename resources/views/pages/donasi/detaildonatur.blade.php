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
                <div class="col col-md-6">
                    <div class="section-title mt-2">
                        <h2>Donatur Uang</h2>
                        <div class="card px-2 py-4 shadow-sm">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_uang" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        
                                            <th>Nama Donatur</th>
                                            <th>Jenis Donasi</th>
                                            <th>Nominal</th>
                                           
                                        </tr>
                                    </thead>
                    
                                    <tbody>
                               
                                        @foreach ($uang as $u)
                                        <tr>
                                            <td>{{$u->nama_donatur}}</td>
                                            <td>{{$u->jenis_donasi}}</td>
                                            <td class="text-right">@currency($u->keterangan_donasi)</td>
                                        </tr>
                                       
                                        @endforeach
                                   
                                     
    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-md-6">
                    <div class="section-title mt-2">
                        <h2>Donatur Barang</h2>
                        <div class="card px-2 py-4 shadow-sm">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_pokok" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        
                                            <th>Nama Donatur</th>
                                            <th>Jenis Donasi</th>
                                            <th>Keterangan</th>
                                           
                                        </tr>
                                    </thead>
                    
                                    <tbody>

                                        @foreach ($barang as $b)
                                        <tr>
                                            <td>{{$b->nama_donatur}}</td>
                                            <td>{{$b->jenis_donasi}}</td>
                                            <td>{{$b->keterangan_donasi}}</td>
                                        </tr>
                                       @endforeach

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="section-title mt-2">
                        <h2>Daftar Donasi Yang Sudah Disalurkan Ke Posko</h2>
                        <div class="card px-2 py-4 shadow-sm">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_penerimaan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                           
                                        </tr>
                                    </thead>
                    
                                    <tbody>
                               
                                        @foreach ($permintaan as $p)
                                        @foreach ($p->pengirimanbarang->detailpengirimanbarang as $item)
                                    
                                            <tr>
                                                <td>{{ Carbon\Carbon::create($item->pengirimanbarang->tanggal_pengiriman )->format('d - m - Y')}}</td>
                                                <td>{{ $item->stokbarang->nama_barang }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->stokbarang->satuan }}</td>
                                            </tr>
                                     
                                     
                                        
                                        @endforeach
                                        @endforeach
                           
                                        
                                       
                  
                                   
                                     
    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
		
		</div>
		
		<div class=" shape shape-1">
             <img src="{{url('donasi_assets/assets/img/shape/1.png')}}" alt="Shape">
		</div>
	</section>
	<!-- End Active Campaign Area -->




@endsection
    
