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
        <h2 style="text-align:center;">Laporan Permintaan Logistik</h2> 
    </div>
    

<table style="margin-bottom: 10px;" cellpadding="5">
    <tbody>
        <tr><th>Per Tanggal</th><td>:</td><td>{{ \Carbon\Carbon::create($startDate)->format('d / m / Y') }}
        - {{ \Carbon\Carbon::create($endDate)->format('d / m / Y') }}</td></tr>
    </tbody>
</table>

<table style="text-align: center; margin-top: 10px;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Permintaan</th>
            <th>Tanggal Permintaan</th>
            <th>Lokasi Bencana</th>
            <th>Status Permintaan</th>
            <th>Status Penerimaan</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
       @forelse ($items as $item)
           
            <tr>
                <td>{{ $item->id_permintaan_barang }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_permintaan)->format('d - m - Y')}}</td>
                <td>{{ $item->infoposko->lokasi_bencana }}</td>
                <td>{{ $item->status_permintaan }}</td>
                <td>{{ $item->status_penerimaan? 'Diterima':'Belum Diterima'}}</td>
                <td>{{ $item->keterangan_permintaan }}</td>   
            </tr>
        @empty 
        <tr>
            <td colspan="6" align="center">Data Kosong</td>    
        </tr> 
        
       @endforelse
       
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


