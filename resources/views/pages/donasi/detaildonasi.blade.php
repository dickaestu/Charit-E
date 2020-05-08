@extends('layouts.donasi.donasi')
@section('title','Detail Donasi')

@section('content')
    


	<!-- Start Page Title Area -->
	<div class="page-title-area item-bg-1">
		<div class="container">
			<div class="page-title-content">
				<h2>Detail Donasi</h2>
				<ul>
					<li>
					<a href="{{route('home')}}">
							Home
							<i class="fa fa-chevron-right"></i>
						</a>
					</li>
					<li>Detail Donasi</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- End Page Title Area -->

	<!-- Start Active Campaign Area -->
	<section class="active-campaing-area">
		<div class="container">
			<div class="section-title mt-2">
				<h2>Daftar Donasi</h2>
				<p>Bencana yang sedang terjadi akhir-akhir ini, anda bisa klik mulai donasi jika ingin melakukan donasi
					dan
					melihat detail kejadian bencana</p>
			</div>

			<div class="row">

				@forelse ($items as $item)
				<div class="col-auto col-md-6">
					<div class="card card-donasi mb-5 shadow-sm">
						<img src="{{Storage::url($item->foto_aktivitas)}}" class="card-img-top">
					   <div class="card-body">
						   <div class="campaing-text">
							   <ul>
								   <li class="mb-2"><i class="flaticon-maps-and-flags"></i><span> {{ $item->info_posko->lokasi_bencana }} </span>
								   </li>
							   </ul>
							   <h3>{{$item->info_posko->jenis_bencana->nama_bencana}}</h3>
							   <p>{{$item->keterangan_aktivitas}}</p>
							  
						   </div>
					   </div>
					   <ul class="list-group list-group-flush">
						   <li class="list-group-item"><i class="flaticon-man-user"></i> Korban<span class="float-right">
								   {{$item->info_posko->jumlah_korban}} Orang</span></li>
						   <li class="list-group-item"><i class="flaticon-human-outline-with-heart"></i> Korban Jiwa<span
								   class="float-right">
								   {{$item->info_posko->jumlah_korban_jiwa}} Orang</span></li>
						   <li class="list-group-item"><i class="flaticon-home"></i> Alamat Posko
							   <span class="float-right">{{$item->info_posko->alamat_posko}}</span>
						   </li>
					   </ul> 

					   <h6 class=" mx-3 my-3">Total Donatur</h6>
					   <p style="color: #000; font-size:16px"  class="text-bold mx-3">
					   {{\App\Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->count()}} Donatur 
					   <span class="float-right"><a href="{{route('detail-donatur',$item->id_aktivitas_donasi)}}">Detail</a></span>
					   </p>

					
					   <div class="bg-light py-2 px-1 shadow-sm rounded">
						<p class="mx-3 text-dark text-bold "> Total Uang
							<span style="color:#1abc7c; font-size:15px;" class="float-right"> @currency(\App\Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->where('jenis_donasi','uang')->sum('keterangan_donasi'))</span>
						</p>
					</div>
					<div class="bg-light py-2 px-1 shadow-sm rounded">
						<p  class="mx-3  text-dark text-bold "> Total Barang
							<span style="color:#fd3c65; font-size:15px;" class="float-right"> {{\App\Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->where('jenis_donasi','pokok')->count()}}</span>
						</p>
					</div>
				   
		   
					<a href="{{route('konfirmasi-donasi',$item->id_aktivitas_donasi)}}" class="default-btn btn-donasi text-center">Mulai Donasi</a>
				   </div>
				</div>
				@empty
					
				@endforelse

			


				


			</div>

				
				
			
				
			</div>
		</div>
		<div class=" shape shape-1">
             <img src="{{url('donasi_assets/assets/img/shape/1.png')}}" alt="Shape">
		</div>
	</section>
	<!-- End Active Campaign Area -->




@endsection
    
