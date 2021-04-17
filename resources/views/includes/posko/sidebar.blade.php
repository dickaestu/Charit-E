<!-- Sidebar -->
<ul class="sidebar navbar-nav  sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('info-posko.index')}}">
      <div class="sidebar-brand-icon">
        <i class="fas fa-campground"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Posko</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    

    <!-- Nav Item - Data Permintaan -->
    <li class="nav-item {{Request::is('posko') || Request::is('posko/data-permintaan/detail-permintaan*') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('data-permintaan')}}">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Data Permintaan</span></a>
    </li>

    <!-- Nav Item - Donasi Masuk -->
    <li class="nav-item {{Request::is('posko/donasi-masuk*') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('donasi-masuk-posko')}}">
        <i class="fas fa-fw fa-hand-holding-heart"></i>
        <span>Donasi Masuk</span></a>
    </li>
  
    <!-- Nav Item - Profile Posko Collapse Menu -->
    <li class="nav-item {{Request::is('posko/info-posko*') ? ' active' : '' }}">
      <a class="nav-link" href="{{route('info-posko.index')}}">
        <i class="fas fa-fw fa-campground"></i>
        <span>Info Posko</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->