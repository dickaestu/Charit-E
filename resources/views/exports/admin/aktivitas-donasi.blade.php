@extends('exports.header.admin')
@section('title','Laporan Aktivitas Donasi')
@push('style')
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
            margin-top: 30px;
        }
    table tr th{
        font-size: 12px;
    }
    
    table tr td{
        font-size: 10px;
    }

</style>
@endpush

@section('content')


<table class="table table-striped table-bordered text-center text-dark">
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

@endsection