@extends('exports.header.admin')
@section('title','Laporan Info Posko')
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
            <th>Nama Posko</th>
            <th>Alamat Posko</th>
            <th>Tanggal Kejadian</th>
            <th>Nama Bencana</th>
            <th>Lokasi Bencana</th>
            <th>Jumlah Korban</th>
            <th>Jumlah Korban Jiwa</th>
            <th>Jumlah Sub Posko</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{$item->user->name}}</td>
                <td>{{$item->alamat_posko}}</td>
                <td>{{Carbon\Carbon::create($item->tanggal_kejadian)->format('d-m-Y')}}</td>
                <td>{{$item->jenis_bencana->nama_bencana}}</td>
                <td>{{$item->lokasi_bencana}}</td>
                <td>{{$item->jumlah_korban}}</td>
                <td>{{$item->jumlah_korban_jiwa}}</td>
                <td>{{$item->subposko->count()}}</td>
                   
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection