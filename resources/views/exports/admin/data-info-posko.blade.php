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
    
        header {
                position: fixed;
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
	
 <header style="margin-top: 70px;">
    <img style="margin-left:70px" src="{{ltrim(public_path('donasi_assets/assets/img/logo.png'),'/')}}" height="auto" width="120">
    <h2 style="text-align:center; margin-top:-30px">Laporan Info Posko</h2> 
</header>
    



<table style="text-align: center; margin-top: 40px;" border="1" cellspacing="0" cellpadding="8" width="100%">
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
<p style="text-align: right; margin-top:60px">Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</p>
<p style="text-align: right; margin-right:45px">Mengetahui,</p>
<p style="text-align: right; margin-right:60px;margin-top:-10px">Pimpinan</p>
<p style="text-align: right; margin-right:5px; margin-top:60px">..................................</p>

</body>
</html>

