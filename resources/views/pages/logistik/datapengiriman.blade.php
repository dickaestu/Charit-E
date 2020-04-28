@extends('layouts.logistik.logistik')
@section('title','Data Pengiriman')
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengiriman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pengiriman</th>
                            <th>Tanggal Keluar</th>
                            <th>ID Posko</th>
                            <th>Nama Posko</th>

                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TRK-00001</td>
                            <td>2020/03/30</td>
                            <td>POS-0001</td>
                            <td>Posko Meruya Utara</td>

                            <td>
                                <button class="btn btn-sm btn-success">Detail</button>

                                <button class="btn btn-sm btn-info">Edit</button>

                                <button class="btn btn-sm btn-danger">Hapus</button>

                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
     
 