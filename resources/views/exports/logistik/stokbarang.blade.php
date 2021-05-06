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
        <h2 style="text-align:center; margin-top:-30px">Laporan Stok Barang</h2> 
    </div>
    


<table style="text-align: center; margin-top: 50px; margin-bottom:50px" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Stok Barang</th>
            <th>Nama Barang</th>
            <th>Quantity</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_stok_barang }}</td>
                <td>{{ $item->nama_barang}}</td>
                <td>{{ $item->quantity}}</td>
                <td>{{ $item->satuan}}</td>
            </tr>
        
       @endforeach
       
    </tbody>
</table>    

<div style=" display: flex;">
    <div >
        <p>Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</p>
        <p>Mengetahui,</p>
        <p style="margin-bottom: 40px">Pimpinan</p>
        <p>................................</p>
    </div>
    <div style="text-align: right">
        <p>Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</p>
        <p>Dilaporkan Oleh,</p>
        <p style="margin-bottom: 40px">Logistik</p>
        <p>................................</p>
    </div>
</div>


</body>
</html>


