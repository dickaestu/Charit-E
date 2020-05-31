<!-- Start Header Area -->
<div class="nivo-header-style-one fixed-top">
    <div class="navbar-area">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="index.html" class="logo">
                 <img src="{{url('donasi_assets/assets/img/logo.png')}}" alt="Logo">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="nivo-nav-one">
            <div class="main-nav">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="container">
                        <a class="navbar-brand mb-1" href="{{route('home')}}">
                            <img src="{{url('donasi_assets/assets/img/logo.png')}}" width="200" alt="Logo">
                        </a>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link {{Request::is('/') ? ' active' : '' }}">Home</a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{route('detail-donasi.index')}}" class="nav-link {{Request::is('detail-donasi') ? ' active' : '' }}">Detail Donasi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('riwayat-donasi')}}" class="nav-link {{Request::is('riwayat-donasi') ? ' active' : '' }}">Riwayat Donasi</a>
                                </li>
                                <li class="nav-item">
                                <a href="{{route('bantuan')}}" class="nav-link {{Request::is('bantuan') ? ' active' : '' }}">Bantuan</a>
                                </li>
                                @guest
                                <li class="nav-item">
                                    <a href="{{url('login')}}" class="nav-link">Login</a>
                                </li>
                                @endguest
                                @auth
                               
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">Akun</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                         <a href="{{ route('settings',Auth::user()->user_id) }}" class="nav-link btn text-left">Settings</a>
                                        </li>
                                        <li class="nav-item">
                                        <form class="ml-2" action="{{url('logout')}}" method="POST">  
                                            @csrf  
                                            <button type="submit" class="nav-link btn">Log out</button>
                                        </form>
                                        </li>
                                    </ul>
                                </li>
                               
                                @endauth

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Header Area -->