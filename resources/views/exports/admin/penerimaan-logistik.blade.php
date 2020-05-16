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
    <h2 style="text-align:center; margin-top:-30px">Laporan Penerimaan Logistik</h2> 
</header>
    



<table style="text-align: center; margin-top: 40px;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Penerimaan</th>
            <th>ID Pengiriman</th>
            <th>Tanggal Penerimaan</th>
            <th>Nama Posko</th>
            <th>Alamat Posko</th>
            <th>Bencana</th>
            <th>Keterangan Penerimaan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_penerimaan_barang }}</td>
                <td>{{ $item->id_pengiriman_barang }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_penerimaan)->format('d - m - Y')}}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->user->name }}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->alamat_posko}}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->jenis_bencana->nama_bencana }}</td>
                <td>{{ $item->keterangan_penerimaan }}</td>
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


