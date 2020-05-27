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
    <h2 style="text-align:center; margin-top:-30px">Laporan Pengeluaran Uang</h2> 
</header>
    



<table style="text-align: center; margin-top: 40px;" border="1" cellspacing="0" cellpadding="8" width="100%">
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
                <td>@currency($total_pengeluaran)</td>
            </tr>
        
       @endforeach
       <tr>
           <td align="center" colspan="3">Sub Total</td>
           <td>@currency($total)</td>
       </tr>
       
    </tbody>
</table>    
<p style="float: right; margin-top:100px;margin-right:10px">Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</p>
<p style="text-align: left;margin-top:33px">Mengetahui, <span style="float: right;margin-right:30px">Dilaporkan Oleh,</span> </p>
<p style="text-align: left;margin-top:-10px">Pimpinan <span style="float: right; margin-right:70px">Logistik</span> </p>
<p style="text-align: left; margin-top:60px;margin-bottom:-400px">..................................  
    <span style="float: right; margin-right:10px">..................................</span></p>

  





</body>
</html>


