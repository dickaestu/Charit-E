@extends('exports.header.admin')
@section('title','Laporan Sub Posko')
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


<table style="margin-bottom: 30px" cellpadding="5">
    <tbody>
        <tr><th>Nama Posko</th><td>:</td><td>{{ $itemm->user->name }}</td></tr>
        <tr><th>Alamat Posko</th><td>:</td><td>{{ $itemm->alamat_posko }}</td></tr>
        <tr><th>Lokasi Bencana</th><td>:</td><td>{{ $itemm->lokasi_bencana }}</td></tr>
        <tr><th>Jenis Bencana</th><td>:</td><td>{{ $itemm->jenis_bencana->nama_bencana }}</td></tr>
        <tr><th>Tanggal Kejadian Bencana</th><td>:</td><td>{{ \Carbon\Carbon::create($itemm->tanggal_kejadian)->format('d - m - Y') }}</td></tr>
     
    </tbody>
</table>

<table class="table table-striped table-bordered text-center text-dark">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Posko</th>
            <th>Penanggung Jawab</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nama_sub_posko}}</td>
                <td>{{$item->nama_penanggung_jawab}}</td>
                   
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection