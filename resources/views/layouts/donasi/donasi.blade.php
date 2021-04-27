{{-- @if(Auth::user()->role=='USER') --}}
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('prepend-style')
    @include('includes.donasi.style')
    @stack('addon-style')
	<!-- TITLE -->
	<title>@yield('title')</title>
</head>

<body>
	<!-- Start Preloader Area -->
	<div class="preloader">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!-- End Preloader Area -->

	@include('includes.donasi.navbar')

    
    @yield('content')



	@include('includes.donasi.footer')

	<!-- Start Go Top Area -->
	<div class="go-top">
		<i class="fa fa-angle-double-up"></i>
		<i class="fa fa-angle-double-up"></i>
	</div>
	<!-- End Go Top Area -->




@stack('prepend-script')
@include('includes.donasi.script')
@stack('addon-script')
</body>


</html>
{{-- @endif --}}