@extends('exports.header.admin')
@section('title','Laporan Uang Masuk')
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
            <th>ID Uang Masuk</th>
            <th>ID Donasi</th>
            <th>Tanggal Masuk</th>
            <th>Nama</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_uang_masuk }}</td>
                <td>{{ $item->id_donasi }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_masuk)->format('d - m - Y')}}</td>
                <td>{{ $item->donasi->nama_donatur }}</td>
                <td>@currency($item->nominal)</td>
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection