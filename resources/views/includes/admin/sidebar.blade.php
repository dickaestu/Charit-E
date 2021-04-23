<!-- Sidebar -->
<ul class="sidebar navbar-nav  sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">

      <div class="sidebar-brand-text mx-3">ADMIN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
  <li class="nav-item {{Request::is('admin') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Master Menu -->
    <li class="nav-item {{Request::is('admin/data-user','admin/data-aktivitas','admin/data-jenis-bencana') ? ' active' : '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true"
        aria-controls="collapseMaster">
        <i class="fas fa-table"></i>
        <span>Master Data</span>
      </a>
      <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{Request::is('admin/data-user') ? ' active' : '' }}" href="{{route('data-user.index')}}">Data User</a>
          <a class="collapse-item {{Request::is('admin/data-aktivitas') ? ' active' : '' }}" href="{{route('data-aktivitas.index')}}">Data Aktivititas Donasi</a>
          <a class="collapse-item {{Request::is('admin/data-jenis-bencana') ? ' active' : '' }}" href="{{route('data-jenis-bencana.index')}}">Data Jenis Bencana</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Permintaan Logistik -->
    <li class="nav-item {{Request::is('admin/data-permintaan*') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-permintaan-admin')}}">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Permintaan Logistik</span></a>
    </li>



    <!-- Nav Item - Info Posko -->
    <li class="nav-item {{Request::is('admin/data-info-posko*') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-info-posko')}}">
        <i class="fas fa-fw fa-campground"></i>
        <span>Data Info Posko</span></a>
    </li>



    <!-- Nav Item - Laporan Collapse Menu -->
    <li class="nav-item {{Request::is('admin/laporan-donasi-masuk',
    'admin/laporan-permintaan',
    'admin/laporan-pengiriman',
    'admin/laporan-penerimaan',
    'admin/laporan-jumlah-stok',
    'admin/laporan-barang-masuk',
    'admin/laporan-jumlah-posko',
    'admin/laporan-aktivitas-donasi') ? ' active' : '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
        aria-expanded="true" aria-controls="collapseLaporan">
        <i class="fas fa-fw fa-folder"></i>
        <span>Laporan</span>
      </a>
      <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Donasi</h6>
          <a class="collapse-item {{Request::is('admin/laporan-donasi-masuk') ? ' active' : '' }}" href="{{route('laporan-donasi-masuk')}}">Donasi Masuk</a>
          <a class="collapse-item {{Request::is('admin/laporan-aktivitas-donasi') ? ' active' : '' }}" href="{{route('laporan-aktivitas-donasi')}}">Aktivitas Donasi</a>
          <h6 class="collapse-header">Logistik</h6>
          <a class="collapse-item {{Request::is('admin/laporan-permintaan') ? ' active' : '' }}" href="{{route('laporan-permintaan')}}">Permintaan Logistik</a>
          <a class="collapse-item {{Request::is('admin/laporan-pengiriman') ? ' active' : '' }}" href="{{route('laporan-pengiriman')}}">Pengiriman Logistik</a>
          <a class="collapse-item {{Request::is('admin/laporan-penerimaan') ? ' active' : '' }}" href="{{route('laporan-penerimaan')}}">Penerimaan Logistik</a>
      
          <h6 class="collapse-header">Stok Barang</h6>
          <a class="collapse-item {{Request::is('admin/laporan-jumlah-stok') ? ' active' : '' }}" href="{{route('laporan-jumlah-stok')}}">Jumlah Stok</a>
          <a class="collapse-item {{Request::is('admin/laporan-barang-masuk') ? ' active' : '' }}" href="{{route('laporan-barang-masuk')}}">Barang Masuk</a>
          
         
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