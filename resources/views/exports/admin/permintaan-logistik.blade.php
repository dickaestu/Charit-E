@extends('exports.header.admin')
@section('title','Laporan Permintaan Logistik')
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
            <th>ID Permintaan</th>
            <th>Tanggal Permintaan</th>
            <th>Lokasi Bencana</th>
            <th>Status Permintaan</th>
            <th>Status Penerimaan</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_permintaan_barang }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_permintaan)->format('d - m - Y')}}</td>
                <td>{{ $item->infoposko->lokasi_bencana }}</td>
                <td>{{ $item->status_permintaan }}</td>
                <td>{{ $item->status_penerimaan? 'Diterima':'Belum Diterima'}}</td>
                <td>{{ $item->keterangan_permintaan }}</td>
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection