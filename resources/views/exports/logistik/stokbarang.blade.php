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
	
    <div style="display: flex; align-items: center; margin-bottom:-30px">
        {{-- pakai ini kalau di hosting src="./donasi_assets/assets/img/logo.png" --}}
        <img  src="{{ltrim(public_path('donasi_assets/assets/img/bpbd.jpg'),'/')}}" height="auto" width="100">
        <h2 style="text-align:center;">Laporan Stok Barang</h2> 
    </div>
    


<table style="text-align: center; " border="1" cellspacing="0" cellpadding="8" width="100%">
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

<div style=" display:flex; ">
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


