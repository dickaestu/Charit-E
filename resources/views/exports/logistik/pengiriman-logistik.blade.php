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
        <h2 style="text-align:center; margin-top:-30px">Laporan Pengiriman Logistik</h2> 
    </div>
        
    



<table style="text-align: center; margin-top: 50px;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Pengiriman</th>
            <th>ID Permintaan</th>
            <th>Tanggal Pengiriman</th>
            <th>Nama Posko</th>
            <th>Alamat Posko</th>
            <th>Bencana</th>
            <th>Keterangan Pengiriman</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_pengiriman_barang }}</td>
                <td>{{ $item->id_permintaan_barang }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_pengiriman)->format('d - m - Y')}}</td>
                <td>{{ $item->permintaanbarang->infoposko->user->name }}</td>
                <td>{{ $item->permintaanbarang->infoposko->alamat_posko}}</td>
                <td>{{ $item->permintaanbarang->infoposko->jenis_bencana->nama_bencana }}</td>
                <td>{{ $item->keterangan_pengiriman }}</td> 
            </tr>
        
       @endforeach
       
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


