<!-- Sidebar -->
<ul class="sidebar navbar-nav  sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard-logistik')}}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-boxes"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Logistik</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Request::is('logistik') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('dashboard-logistik')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Donasi Masuk -->
    <li class="nav-item {{Request::is('logistik/donasi-masuk') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('donasi-masuk-logistik')}}">
        <i class="fas fa-fw fa-hand-holding-heart"></i>
        <span>Donasi Masuk</span></a>
    </li>

    <!-- Nav Item - Data Uang Donasi Collapse Menu -->
    <li class="nav-item {{Request::is('logistik/data-uang-donasi') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-uang-donasi-logistik')}}">
        <i class="fas fa-fw fa-donate"></i>
        <span>Data Uang Masuk</span></a>
    </li>



    <!-- Nav Item - Data Stok Barang Collapse Menu -->
    <li class="nav-item {{Request::is('logistik/data-stok-barang') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-stok-barang.index')}}">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Data Stok Barang</span></a>
    </li>

    <!-- Nav Item - Data Barang Masuk -->
    <li class="nav-item {{Request::is('logistik/data-barang-masuk') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-barang-masuk-logistik')}}">
        <i class="fas fa-fw fa-sign-in-alt"></i>
        <span>Data Barang Masuk</span></a>
    </li>

    <!-- Nav Item - Data Permintaan -->
    <li class="nav-item {{Request::is('logistik/data-permintaan') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-permintaan-logistik')}}">
        <i class="fas fa-fw fa-clipboard-check"></i>
        <span>Data Permintaan</span></a>
    </li>

    <!-- Nav Item - Data Pengiriman -->
    <li class="nav-item {{Request::is('logistik/data-pengiriman') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-pengiriman-logistik')}}">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Data Pengiriman</span></a>
    </li>

     <!-- Nav Item - Transaksi Pemasukan -->
     <li class="nav-item {{Request::is('logistik/transaksi-pemasukan') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('transaksi-pemasukan-logistik')}}">
        <i class="fas fa-truck"></i>
        <span>Transaksi Pemasukan</span></a>
    </li>

   
    <!-- Nav Item - Laporan -->
    <li class="nav-item {{Request::is('logistik/laporan-permintaan',
    'logistik/laporan-donasi-masuk','logistik/laporan-uang-donasi',
    'logistik/laporan-stok-barang','logistik/laporan-pengiriman',
    'logistik/laporan-barang-masuk') ? ' active' : '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
        aria-expanded="true" aria-controls="collapseLaporan">
        <i class="fas fa-list"></i>
        <span>Laporan</span>
      </a>
      <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{Request::is('logistik/laporan-permintaan') ? ' active' : '' }}" href="{{route('laporan-permintaan-logistik')}}">Permintaan Barang</a>
          <a class="collapse-item {{Request::is('logistik/laporan-donasi-masuk') ? ' active' : '' }}" href="{{route('laporan-donasi-masuk-logistik')}}">Donasi Masuk</a>
          <a class="collapse-item {{Request::is('logistik/laporan-uang-donasi') ? ' active' : '' }}" href="{{route('laporan-uang-donasi-logistik')}}">Uang Masuk</a>
          <a class="collapse-item {{Request::is('logistik/laporan-stok-barang') ? ' active' : '' }}" href="{{route('laporan-stok-barang-logistik')}}">Stok Barang</a>
          <a class="collapse-item {{Request::is('logistik/laporan-pengiriman') ? ' active' : '' }}" href="{{route('laporan-pengiriman-logistik')}}">Pengiriman</a>
         
          <a class="collapse-item {{Request::is('logistik/laporan-barang-masuk') ? ' active' : '' }}" href="{{route('laporan-barang-masuk-logistik')}}">Barang Masuk</a>
        </div>
      </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->