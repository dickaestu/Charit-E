@extends('exports.header.logistik')
@section('title','Laporan Donasi Masuk')
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
tes logistik

<table class="table table-striped table-bordered text-center text-dark">
    <thead>
        <tr>
            <th>ID Donasi</th>
            <th>Tanggal Donasi</th>
            <th>Lokasi Bencana</th>
            <th>Nama Donatur</th>
            <th>Status Verifikasi</th>
            <th>Jenis Donasi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_donasi }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_donasi)->format('d - m - Y')}}</td>
                <td>{{ $item->aktivitasdonasi->info_posko->lokasi_bencana }}</td>
                <td>{{ $item->nama_donatur }}</td>
                <td>{{ $item->status_verifikasi ? 'Verified' : 'Pending' }}</td>
                <td>{{ $item->jenis_donasi }}</td>
                <td>{{ $item->keterangan_donasi }}</td>
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection