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
        <h2 style="text-align:center;">Laporan Donasi Masuk</h2> 
    </div>
    
    <div style="width: 100%">
        <table style="text-align: center;  width:100%" border="1" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th>ID Donasi</th>
                    <th>Tanggal Donasi</th>
                    <th>Nama Bencana</th>
                    <th>Lokasi Bencana</th>
                    <th>Nama Donatur</th>
                    <th>Status Verifikasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                
                <tr>
                    <td>{{$item->id_donasi}}</td>     
                    <td>{{\Carbon\Carbon::create($item->tanggal_donasi)->format('d-M-Y')}}</td>
                    <td>{{ $item->aktivitasdonasi->info_posko->jenis_bencana->nama_bencana }}</td>
                    <td>{{ $item->aktivitasdonasi->info_posko->lokasi_bencana }}</td>    
                    <td>{{ $item->is_anonim ? 'Anonim' : $item->user->name }}</td>
                    <td>{{ $item->status_verifikasi ? 'Verified' : 'Not Verified' }}</td>    
                    <td>{{ $item->keterangan_donasi }}</td>       
                </tr>
                @empty 
                <tr>
                    <td colspan="7" align="center">Data Kosong</td>
                </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
    <div style="margin-top: 30px; text-align:right">
        <p>Jakarta, {{ \Carbon\Carbon::now()->format('d - m - Y') }}</p>
        <p>Mengetahui,</p>
        <p style="margin-bottom: 40px">Pimpinan</p>
        <p>................................</p>
    </div>
    
</body>
</html>

