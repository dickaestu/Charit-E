<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style type="text/css">

        @page {
                margin: 0cm 0cm;
            }
        body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
                color: #000;
            }
    
        
        table tr th{
            font-size: 15px;
        }
        
        table tr td{
            font-size: 12px;
        }

        p {
            font-size: 12px;
        }

    
    </style>
    
</head>
<body>
	
<div>
    <img style="" src="{{ltrim(public_path('donasi_assets/assets/img/logo.png'),'/')}}" height="auto" width="120">
    <h2 style="text-align:center; margin-top:-30px">Laporan Sub Posko</h2> 
</div>
    
	

<table style="margin-bottom: 10px; margin-top:50px;" cellpadding="5">
    <tbody>
        <tr><th style="text-align:left">Nama Posko</th><td>:</td><td>{{ $itemm->user->name }}</td></tr>
        <tr><th style="text-align:left">Alamat Posko</th><td>:</td><td>{{ $itemm->alamat_posko }}</td></tr>
        <tr><th style="text-align:left">Lokasi Bencana</th><td>:</td><td>{{ $itemm->lokasi_bencana }}</td></tr>
        <tr><th style="text-align:left">Jenis Bencana</th><td>:</td><td>{{ $itemm->jenis_bencana->nama_bencana }}</td></tr>
        <tr><th style="text-align:left">Tanggal Kejadian Bencana</th><td>:</td><td>{{ \Carbon\Carbon::create($itemm->tanggal_kejadian)->format('d - m - Y') }}</td></tr>
     
    </tbody>
</table>

<table style="text-align: center" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Posko</th>
            <th>Penanggung Jawab</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
           
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->nama_sub_posko}}</td>
            <td>{{$item->nama_penanggung_jawab}}</td>
               
        </tr>
    
   @endforeach
       
    </tbody>
</table>
<table style="margin-top: 30px" width="640px">
    <tr>
        <td align="right">Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</td>
    </tr>
    <tr>
        <td align="right"><span style="margin-right:45px">Mengetahui,</span></td>
    </tr>
    <tr>
        <td align="right"><span style="margin-right:60px">Pimpinan</span></td>
    </tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr><td></td></tr>
    <tr>
        <td align="right"><span style="margin-right:5px;">.................................. </span> 
       </td>
    </tr>
</table>

</body>
</html>



