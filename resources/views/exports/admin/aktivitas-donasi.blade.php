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
        <h2 style="text-align:center; margin-top:-30px">Laporan Aktivitas Donasi</h2> 
    </div>
    



<table style="text-align: center; margin-top: 50px;" border="1" cellspacing="0" cellpadding="8" width="100%">
    <thead>
        <tr>
            <th>ID Aktivitas Donasi</th>
            <th>Tanggal Kejadian</th>
            <th>Nama Posko</th>
            <th>Nama Bencana</th>
            <th>Lokasi Bencana</th>
            <th>Jumlah Donasi Uang</th>
            <th>Jumlah Donasi Barang</th>
            <th>Total Donasi</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
           
            <tr>
                <td>{{ $item->id_aktivitas_donasi }}</td>
                <td>{{\Carbon\Carbon::create( $item->info_posko->tanggal_kejadian)->format('d - m - Y')}}</td>
                <td>{{ $item->info_posko->user->name }}</td>
                <td>{{ $item->info_posko->jenis_bencana->nama_bencana }}</td>
                <td>{{ $item->info_posko->lokasi_bencana }}</td>
                <td>@currency(\App\Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->where('jenis_donasi','uang')->sum('keterangan_donasi'))</td>
                <td>{{\App\Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->where('jenis_donasi','pokok')->count()}}</td>
                <td>{{\App\Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->count()}}</td>
            </tr>
        
       @endforeach
       
    </tbody>
</table>
<table style="margin-top: 30px" width="640px">
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

