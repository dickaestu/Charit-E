@extends('layouts.admin.admin')
@section('title','Laporan Permintaan Logistik')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">

    <button class="btn btn-primary mb-2">Cetak Semua</button>
    <div class="col col-md-5">
        <div class="card mb-2">
            <div class="card-body">
                <label for="dariTanggal">Dari Tanggal :</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="date" class="form-control datepicker" id="dariTanggal"
                        placeholder="Pilih Tanggal">
                </div>

                <label for="dariTanggal">Sampai Tanggal :</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="date" class="form-control datepicker" id="dariTanggal"
                        placeholder="Pilih Tanggal">
                </div>
                <a href="#" class="btn btn-primary btn-secondary">Cetak</a>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Permintaan Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Permintaan</th>
                            <th>Tanggal Permintaan</th>
                            <th>ID Posko</th>
                            <th>Nama Posko</th>
                            <th>Status</th>
                            <th>Detail</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PER-00001</td>
                            <td>2020/03/30</td>
                            <td>POS-0001</td>
                            <td>Posko Meruya Utara</td>
                            <td>Belum Dikirim</td>

                            <td>
                                <p>- Pakaian Atas <span>10</span> <span>dus</span></p>


                            </td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection


@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>
@endpush