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
        <h2 style="text-align:center;">Laporan Penerimaan Logistik</h2> 
    </div>
    
<table style="margin-bottom: 10px; " cellpadding="5">
    <tbody>
        <tr><th>Periode</th><td>:</td><td>{{ \Carbon\Carbon::create($startDate)->format('d / m / Y') }}
        - {{ \Carbon\Carbon::create($endDate)->format('d / m / Y') }}</td></tr>
    </tbody>
</table>


<table style="text-align: center;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Penerimaan</th>
            <th>ID Pengiriman</th>
            <th>Tanggal Penerimaan</th>
            <th>Nama Posko</th>
            <th>Nama Penanggung Jawab</th>
            <th>Alamat Posko</th>
            <th>Bencana</th>
            <th>Keterangan Penerimaan</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($items as $item)
           
            <tr>
                <td>{{ $item->id_penerimaan_barang }}</td>
                <td>{{ $item->id_pengiriman_barang }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_penerimaan)->format('d - m - Y')}}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->user->name }}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->nama_penanggung_jawab }}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->alamat_posko}}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->jenis_bencana->nama_bencana }}</td>
                <td>{{ $item->keterangan_penerimaan }}</td>
            </tr>
       @empty
       <tr>
            <td colspan="7" align="center">Data Kosong</td>   
        </tr> 

       @endforelse
       
    </tbody>
</table>
<table style="margin-top: 30px" width="100%">
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


