@extends('layouts.donasi.donasi')
@section('title','Charit-E')
@section('content')
<!-- Start Banner Area -->
<section class="banner-area">
    <div class="container">
        <div class="banner-wrap">
            @if (session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}</div>
            @endif
            <div class="row align-items-center m-0">
                <div class="col-lg-6 p-0">
                    <div class="banner-text">
                        <span>Jadikan Niat Baik Menjadi Hal Baik Hari ini</span>
                        <h1>Kami Mengajak Anda Untuk Beramal</h1>
                        <p>Terlibat dalam amal dapat memberi Anda perasaan yang baik! Kontribusi Anda dapat membuat
                            Anda lebih lengkap. Jutaan orang membutuhkan dukungan Anda.</p>
                        <a class="default-btn" href="{{route('detail-donasi.index')}}">Donasi Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="banner-img">
                         <img src="{{url('donasi_assets/assets/img/banner-img.png')}}" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" shape shape-1">
        <img src="{{url('donasi_assets/assets/img/shape/1.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-2">
        <img src="{{url('donasi_assets/assets/img/shape/2.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-3">
        <img src="{{url('donasi_assets/assets/img/shape/3.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-4">
        <img src="{{url('donasi_assets/assets/img/shape/4.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-5">
        <img src="{{url('donasi_assets/assets/img/shape/5.png')}}" alt="Shape">
    </div>
</section>
<!-- End Banner Area -->

<!-- Start Jenis Bantuan Area -->
<section class="good-causes-area ptb-100-70">
    <div class="container">
        <div class="section-title">
            <span>Jenis Bantuan</span>
            <h2>Bantu Saudara Kita Melalui Kami</h2>
            <p>Berbagai jenis bantuan yang diberikan dengan maksud untuk mengurangi beban mereka yang terkena
                musibah. Apapun jenis bantuan yang akan anda berikan, kami akan dengan senang hati mengelolanya dan
                akan disalurkan tepat sasaran
            </p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-good-causes">
                    <i class="flaticon-gift"></i>
                    <h3>Barang</h3>
                    <p>Berbagai jenis barang seperti pakaian, perabotan rumah tangga dan lain-lain untuk korban
                        bencana</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-good-causes">
                    <i class="flaticon-customer"></i>
                    <h3>Bantuan Sukarelawan</h3>
                    <p>Para sukarelawan akan membantu segala kebutuhan yang dibutuhkan para korban.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-good-causes">
                    <i class="flaticon-coin"></i>
                    <h3>Pengobatan</h3>
                    <p>Bantuan obat-obatan dan perawatan medis untuk menjaga kesehatan korban bencana.</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-good-causes">
                    <i class="flaticon-family"></i>
                    <h3>Bantuan Renovasi</h3>
                    <p>Bantuan untuk merenovasi tempat tinggal korban bencana yang mengalami kerusakan.</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-good-causes">
                    <i class="flaticon-harvest"></i>
                    <h3>Makanan</h3>
                    <p>Bantuan makanan/minuman yang sehat dan layak untuk korban bencana. Terdapat juga dapur umum.
                    </p>

                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-good-causes">
                    <i class="flaticon-smile"></i>
                    <h3>Rehabilitasi</h3>
                    <p>Rehabilitasi pasca bencana guna pemulihan psikologis dan perbaikan sarana & prasarana</p>

                </div>
            </div>
        </div>
    </div>
    <div class=" shape shape-1">
        <img src="{{url('donasi_assets/assets/img/shape/1.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-2">
        <img src="{{url('donasi_assets/assets/img/shape/2.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-3">
        <img src="{{url('donasi_assets/assets/img/shape/3.png')}}" alt="Shape">
    </div>
    <div class=" shape shape-5">
        <img src="{{url('donasi_assets/assets/img/shape/5.png')}}" alt="Shape">
    </div>
</section>
<!-- End Good Causes Area -->

<!-- Start Active Campaign Area -->
<hr>
<section class="active-campaing-area">

    
    <div class="container">
        <div class="section-title">
            <span>Daftar Aktivitas</span>
            <h2>Aktivitas Terkini</h2>
            <p>Bencana yang sedang terjadi hari ini, anda bisa klik donasi jika ingin melakukan donasi dan
                melihat detail kejadian bencana</p>
        </div>
        <div class="campaing-wrap owl-carousel owl-theme">
          @foreach ($items as $item)
          <div class="single-campaing">
            <div class="campaing-img" style="background: white">
                 <img src="{{Storage::url($item->foto_aktivitas)}}" alt="">
            </div>
            <div class="campaing-text">
                <ul>
                    <li><i class="flaticon-maps-and-flags"></i><span>Location : </span></li>
                    <li class="left-site">{{$item->info_posko->lokasi_bencana}}</li>
                </ul>
                <h3>{{$item->info_posko->jenis_bencana->nama_bencana}}</h3>
                <p>{{$item->keterangan_aktivitas}}</p>

                <hr>
                <h6>Total Donatur</h6>
                <p style="color: #000; font-size:16px"  class="text-bold">
                {{ number_format($item->donasi->count()) }} Donatur 
                <span class="float-right"><a href="{{route('detail-donatur',$item->id_aktivitas_donasi)}}">Detail</a></span>
                </p>
              
                <hr>

                {{-- <div class="bg-light py-2 px-1 shadow-sm rounded mt-2">
                    <p  class="mx-1  text-dark text-bold "> Total Barang
                        <span style="color:#fd3c65; font-size:15px;" class="float-right">50</span>
                    </p>
                </div> --}}
                
 
                <a class="read-more mt-4" href="{{route('detail-donasi.index')}}">Lihat Info</a>
            </div>
        </div>      
          @endforeach    
        </div>
        @if ($items == "[]")
            <div class="card text-center">
                <div class="card-body">
                    Belum Ada Aktivitas Donasi
                </div>
            </div>
        @endif
    </div>
    <div class=" shape shape-1">
          <img src="{{url('donasi_assets/assets/img/shape/1.png')}}" alt="Shape">
    </div>
</section>
<!-- End Active Campaign Area -->

<!-- Start About Area -->
<section class="about-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="{{url('donasi_assets/assets/img/about.png')}}" alt="About">
                    <div class="shape shape-6">
                        <img src="{{url('donasi_assets/assets/img/shape/6.png')}}" alt="">
                    </div>
                    <div class="shape shape-7">
                        <img src="{{url('donasi_assets/assets/img/shape/7.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-text">
                    <span>Tentang Kami</span>
                    <h2>A Dream in their Mind is Our Mission</h2>
                    <p>Charit-E merupakan aplikasi untuk memberikan donasi, dimana para donatur tidak hanya bisa donasi berupa uang
                        melainkan barang-barang seperti kebutuhan pokok pun bisa. Donasi tersebut akan di alokasikan kepada para korban
                        bencana.
                    </p>
                    <ul>
                        <li>
                            <i class="flaticon-check-mark"></i>
                            Berikan Bantuan Kepada Korban Bencana Alam
                        </li>
                        <li>
                            <i class="flaticon-check-mark"></i>
                            Bisa melihat info posko-posko
                        </li>
                        <li>
                            <i class="flaticon-check-mark"></i>
                            Bisa melihat info bencana
                        </li>
                        <li>
                            <i class="flaticon-check-mark"></i>
                            Bisa melihat info korban bencana
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="shape shape-8">
        <img src="{{url('donasi_assets/assets/img/shape/8.png')}}" alt="shape">
    </div>
    <div class="shape shape-9">
        <img src="{{url('donasi_assets/assets/img/shape/9.png')}}" alt="shape">
    </div>
    <div class="shape shape-10">
        <img src="{{url('donasi_assets/assets/img/shape/10.png')}}" alt="shape">
    </div>
</section>
<!-- End About Area -->

@endsection