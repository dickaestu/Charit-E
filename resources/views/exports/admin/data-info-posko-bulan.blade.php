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
        <h2 style="text-align:center;">Laporan Info Posko</h2> 
    </div>
    
    
    <table style="margin-bottom: 10px; " cellpadding="5">
        <tbody>
            <tr><th>Periode</th><td>:</td><td>{{ \Carbon\Carbon::create($startDate)->format('d / m / Y') }}
                - {{ \Carbon\Carbon::create($endDate)->format('d / m / Y') }}</td></tr>
            </tbody>
        </table>
        
        <div style="width: 100%">
            <table style="text-align: center; margin-top: 10px; width:100%" border="1" cellspacing="0" cellpadding="8">
                <thead>
                    <tr>
                        <th>Nama Posko</th>
                        <th>Alamat Posko</th>
                        <th>Tanggal Kejadian</th>
                        <th>Nama Bencana</th>
                        <th>Lokasi Bencana</th>
                        <th>Jumlah Korban</th>
                        <th>Jumlah Korban Jiwa</th>
                        <th>Jumlah Sub Posko</th>
                        <th>Nama Penanggung Jawab</th>
                        <th>No HP Penanggung Jawab</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    
                    <tr>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->alamat_posko}}</td>
                        <td>{{Carbon\Carbon::create($item->tanggal_kejadian)->format('d-m-Y')}}</td>
                        <td>{{$item->jenis_bencana->nama_bencana}}</td>
                        <td>{{$item->lokasi_bencana}}</td>
                        <td>{{$item->jumlah_korban}}</td>
                        <td>{{$item->jumlah_korban_jiwa}}</td>
                        <td>{{$item->subposko->count()}}</td>     
                        <td>{{$item->nama_penanggung_jawab}}</td>     
                        <td>{{$item->no_hp_penanggung_jawab}}</td>     
                    </tr>
                    
                    @empty
                    <tr>
                        <td colspan="10" align="center">Data Kosong</td>
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
    
    