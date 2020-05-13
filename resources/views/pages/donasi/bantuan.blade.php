@extends('layouts.donasi.donasi')
@section('title','Bantuan')
@section('content')
    
<!-- Start Page Title Area -->
		<div class="page-title-area item-bg-9">
			<div class="container">
				<div class="page-title-content">
					<h2>Bantuan</h2>
					<ul>
						<li>
							<a href="{{ route('home') }}">
								Home 
								<i class="fa fa-chevron-right"></i>
							</a>
						</li>
						<li>Bantuan</li>
					</ul>
				</div>
			</div>
		</div>
        <!-- End Page Title Area -->

	<!-- Start Get Started Today Area -->
		<section class="get-started-today-area pt-100">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<div class="get-started-img">
							<img src="{{ url('donasi_assets/assets/img/get-started/get-started.png') }}" alt="Donation">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="get-started-title">
							<span>Bantuan</span>
							<h2>Cara Donasi</h2>
							<p>Jika ingin berdonasi dapat mengikuti cara ini</p>
						</div>
						<div class="get-started-list mb-4 mt-4">
						
							<h3>Lihat Daftar Aktivitas Donasi</h3>
							<p>Pilih aktivitas donasi yang di inginkan kemudia klik detail donasi</p>
						</div>
						<div class="get-started-list mb-4">
						
							<h3>Detail Donasi</h3>
							<p>Pada halaman ini tersedia info bencana dan info posko dari setiap aktivitas donasi, klik mulai donasi untuk melanjutkan</p>
						</div>
						<div class="get-started-list mb-4">
							
							<h3>Mulai Donasi</h3>
							<p>Isi form yang tersedia dan pilih jenis donasi apa yang diinginkan, pastikan anda membaca ketentuan donasi dari setiap jenis donasi untuk menghindari kesalahan</p>
						</div>
						<a class="default-btn" href="#">
							Get Started
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- End Get Started Today Area -->
        <div class="section-title" style="margin-top: 150px">
            <h2>Contact Us</h2>
            <p>Hubungi kami jika ada pertanyaan</p>
        </div>
        <!-- Start Contact Box Area -->
		<section class="contact-box ptb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="single-contact-box">
							<i class="fa fa-map-marker"></i>
							<div class="contect-title">
								<h3>Address</h3>
								<p>Jakarta Barat</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-contact-box">
							<i class="fa fa-envelope"></i>
							<div class="contect-title">
								<h3>Email</h3>
								<a href="#">support@charite.com</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
						<div class="single-contact-box">
							<i class="fa fa-phone"></i>
							<div class="contect-title">
								<h3>Phone</h3>
								<a href="#">021 123 456</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact Box Area -->

@endsection