@extends('exports.header.admin')
@section('title','Laporan Penerimaan Logistik')
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
            <th>ID Penerimaan</th>
            <th>ID Pengiriman</th>
            <th>Tanggal Penerimaan</th>
            <th>Nama Posko</th>
            <th>Alamat Posko</th>
            <th>Bencana</th>
            <th>Keterangan Penerimaan</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $item->id_penerimaan_barang }}</td>
                <td>{{ $item->id_pengiriman_barang }}</td>
                <td>{{\Carbon\Carbon::create( $item->tanggal_penerimaan)->format('d - m - Y')}}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->user->name }}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->alamat_posko}}</td>
                <td>{{ $item->pengirimanbarang->permintaanbarang->infoposko->jenis_bencana->nama_bencana }}</td>
                <td>{{ $item->keterangan_penerimaan }}</td>
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection