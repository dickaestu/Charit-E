@extends('exports.header.admin')
@section('title','Laporan Detail Penerimaan Logistik')
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
        <tr><th >ID Penerimaan</th><td>:</td><td>{{ $penerimaan->id_penerimaan_barang }}</td></tr>
        <tr><th >Tanggal Penerimaan</th><td>:</td><td>{{ \Carbon\Carbon::create($penerimaan->tanggal_penerimaan)->format('d - m - Y') }}</td></tr>
        <tr><th >Nama Posko</th><td>:</td><td>{{ $penerimaan->pengirimanbarang->permintaanbarang->infoposko->user->name }}</td></tr>
        <tr><th >Alamat Posko</th><td>:</td><td>{{ $penerimaan->pengirimanbarang->permintaanbarang->infoposko->alamat_posko }}</td></tr>
        <tr><th >Lokasi Bencana</th><td>:</td><td>{{ $penerimaan->pengirimanbarang->permintaanbarang->infoposko->lokasi_bencana }}</td></tr>
        <tr><th >Nama Bencana</th><td>:</td><td>{{ $penerimaan->pengirimanbarang->permintaanbarang->infoposko->jenis_bencana->nama_bencana }}</td></tr>
    </tbody>
</table>
<table class="table table-striped table-bordered text-center text-dark">
    <thead>
       
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($items as $item)
           
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->stokbarang->nama_barang }}</td>
                <td>{{ $item->stokbarang->satuan }}</td>
                <td>{{$item->jumlah_penerimaan}}</td>
            </tr>
        
       @endforeach
    </tbody>
</table>

@endsection