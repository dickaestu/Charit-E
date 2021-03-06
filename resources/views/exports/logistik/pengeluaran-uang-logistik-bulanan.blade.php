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
        <h2 style="text-align:center; margin-top:-30px">Laporan Pengeluaran Uang</h2> 
    </div>
        
    

<table style="margin-bottom: 10px; margin-top:50px;" cellpadding="5">
    <tbody>
        <tr><th>Per Tanggal</th><td>:</td><td>{{ \Carbon\Carbon::create($startDate)->format('d / m / Y') }}
        - {{ \Carbon\Carbon::create($endDate)->format('d / m / Y') }}</td></tr>
    </tbody>
</table>

<table style="text-align: center; margin-top: 10px;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Pengeluaran</th>
            <th>Tanggal Pengeluaran</th>
            <th>Keterangan Pengeluaran</th>
            <th>Total Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
           
        <tr>
            <td>{{ $item->id_pengeluaran_uang }}</td>
            <td>{{\Carbon\Carbon::create( $item->tanggal_pengeluaran)->format('d - m - Y')}}</td>
            <td>{{ $item->keterangan_pengeluaran }}</td>
            <td>@currency($item->total_pengeluaran)</td>
        </tr>
    
   @endforeach
   <tr>
       <td align="center" colspan="3">Sub Total</td>
       <td>@currency($total)</td>
   </tr>
       
    </tbody>
</table>    

<table style="margin-top: 30px" width="640px">
    <tr>
        <td align="right">Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</td>
    </tr>
    <tr>
        <td align="left">Mengetahui, <span style="margin-left:465px">Dilaporkan Oleh,</span></td>
    </tr>
    <tr>
        <td align="left">Pimpinan <span style="margin-left:485px">Logistik</span></td>
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
        <td align="left">.................................. 
            <span style="margin-left:420px">..................................</span></td>
    </tr>
</table>
  





</body>
</html>


