
{{-- @if (Auth::user()->role=='LOGISTIK') --}}
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  @stack('prepend-style')
  @include('includes.logistik.style')
  @stack('addon-style')

  <title>@yield('title')</title>
 
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('includes.logistik.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include('includes.logistik.topbar')

       @yield('content')

      </div>
      <!-- End of Main Content -->

      @include('includes.logistik.footer')

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 


  @stack('prepend-script')
  @include('includes.logistik.script')
  @stack('addon-script')

</body>

</html>

{{-- @endif --}}