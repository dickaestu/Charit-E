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
        <h2 style="text-align:center; margin-top:-30px">Laporan Info Posko</h2> 
    </div>
        
	

<table style="margin-bottom: 10px; margin-top:50px;" cellpadding="5">
    <tbody>
        <tr><th>Nama Bencana</th><td>:</td><td>{{ $jenis_bencana->nama_bencana }}</td></tr>
    </tbody>
</table>

<table style="text-align: center" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>Nama Posko</th>
            <th>Alamat Posko</th>
            <th>Tanggal Kejadian</th>
            <th>Nama Bencana</th>
            <th>Lokasi Bencana</th>
            <th>Jumlah Korban</th>
            <th>Jumlah Korban Jiwa</th>
            <th>Jumlah Sub Posko</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{$item->user->name}}</td>
                <td>{{$item->alamat_posko}}</td>
                <td>{{Carbon\Carbon::create($item->tanggal_kejadian)->format('d-m-Y')}}</td>
                <td>{{$item->jenis_bencana->nama_bencana}}</td>
                <td>{{$item->lokasi_bencana}}</td>
                <td>{{$item->jumlah_korban}}</td>
                <td>{{$item->jumlah_korban_jiwa}}</td>
                <td>{{$item->subposko->count()}}</td>     
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

