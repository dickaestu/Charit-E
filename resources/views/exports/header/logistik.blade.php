<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="{{ltrim(public_path('backend_assets/css/sb-admin-2.css'),'/')}}" rel="stylesheet" type="text/css">

  @stack('style')
    
</head>
<body>
	
 <header>
    <table width="100%">
        <tr>
        <td align="center"><img src="{{ltrim(public_path('donasi_assets/assets/img/logo.png'),'/')}}" height="auto" width="120"></td>
        <td> <h4 class="">@yield('title')</h4></td>
        
        </tr>
        </table>
</header>
	
@yield('content') 

</body>
</html>



