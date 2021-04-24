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
        {{-- pakai ini kalau di hosting src="./donasi_assets/assets/img/logo.png" --}}
        <img style="" src="{{ltrim(public_path('donasi_assets/assets/img/logo.png'),'/')}}" height="auto" width="120">
        <h2 style="text-align:center; margin-top:-30px">Laporan Penerimaan Logistik</h2> 
    </div>
    
    
    <table style="margin-bottom: 10px; margin-top:50px;" cellpadding="5">
        <tbody>
            <tr><th>Nama Bencana</th><td>:</td><td>{{ $jenis_bencana->nama_bencana }}</td></tr>
        </tbody>
    </table>
    
    <table style="text-align: center" border="1" cellspacing="0" cellpadding="8" width="100%">
        <thead>
            <tr>
                <th>ID Aktivitas Donasi</th>
                <th>Tanggal Kejadian</th>
                <th>ID Info Posko</th>
                <th>Nama Posko</th>
                <th>Nama Bencana</th>
                <th>Lokasi Bencana</th>
                <th>Total Donasi Yang Diterima</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
            <tr>
                <td>{{ $item->id_aktivitas_donasi }}</td>    
                <td>{{ $item->tanggal_kejadian }}</td>  
                <td>{{ $item->id_info_posko }}</td>  
                <td>{{ $item->nama_posko }}</td>  
                <td>{{ $item->nama_bencana }}</td>  
                <td>{{ $item->lokasi_bencana }}</td>  
                <td>{{ $item->total_donasi }}</td>  
            </tr>    
            @empty
            <tr>
                <td colspan="7" align="center">Data Kosong</td>
            </tr>
            @endforelse
            
        </tbody>
    </table>
    <div style="margin-top: 30px; text-align:right">
        <p>Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</p>
        <p>Mengetahui,</p>
        <p style="margin-bottom: 40px">Pimpinan</p>
        <p>................................</p>
    </div>
</body>
</html>

