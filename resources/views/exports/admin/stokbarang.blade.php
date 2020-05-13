@extends('exports.header.admin')
@section('title','Laporan Jumlah Stok Barang')
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
            <th>ID Stok Barang</th>
            <th>Nama Barang</th>
            <th>Quantity</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_stok_barang }}</td>
                <td>{{ $item->nama_barang}}</td>
                <td>{{ $item->quantity}}</td>
                <td>{{ $item->satuan}}</td>
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection