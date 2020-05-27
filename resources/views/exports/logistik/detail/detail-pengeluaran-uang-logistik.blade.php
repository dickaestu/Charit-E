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
    <h2 style="text-align:center; margin-top:-30px">Laporan Detail Pengeluaran Uang</h2> 
</header>
    

<table style="margin-bottom: 10px;margin-top: 50px" cellpadding="5">
    <tbody>
        <tr><th align="left">ID Pengeluaran Uang</th><td>:</td><td>{{ $pengeluaran->id_pengeluaran_uang }}</td></tr>
        <tr><th align="left">Tanggal Pengeluaran</th><td>:</td><td>{{ \Carbon\Carbon::create($pengeluaran->tanggal_pengeluaran)->format('d - m - Y') }}</td></tr>
        <tr><th align="left">Keterangan Pengeluaran</th><td>:</td><td>{{ $pengeluaran->keterangan_pengeluaran }}</td></tr>
   </tbody>
</table>

<table style="text-align: center; margin-top: 10px;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->stokbarang->nama_barang }}</td>
                <td>{{ $item->stokbarang->satuan }}</td>
                <td>{{$item->jumlah}}</td>
                <td>@currency($item->nominal)</td>
            </tr>
          
        
       @endforeach
       <tr>
        <td align="center" colspan="4">Sub Total</td>
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




