@extends('layouts.logistik.logistik')
@section('title','Laporan Pengiriman')

@push('addon-style')
<link rel="stylesheet" href="{{url('backend_assets/vendor/gijgo/css/gijgo.min.css')}}">
@endpush
    
@section('content')
   <!-- Begin Page Content -->
   <div class="container-fluid">

    <button class="btn btn-primary mb-2">Cetak Semua</button>
    <div class="col col-md-5">
        <div class="card mb-2">
            <div class="card-body">
                <label for="dariTanggal">Dari Tanggal :</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control datepicker" id="dariTanggal"
                        placeholder="Pilih Tanggal">
                </div>

                <label for="sampaiTanggal">Sampai Tanggal :</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control datepicker2" id="sampaiTanggal"
                        placeholder="Pilih Tanggal">
                </div>
                <a href="#" class="btn btn-primary btn-secondary">Cetak</a>
            </div>
        </div>
    </div>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pengiriman</h6>
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
                            <th>Detail</th>



                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>TRK-00001</td>
                            <td>2020/03/30</td>
                            <td>POS-0001</td>
                            <td>Posko Meruya Utara</td>
                            <td>
                                <p>- Pakaian Atas <span>20</span> <span>dus</span></p>
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
     
@push('addon-script')
<script src="{{url('backend_assets/vendor/gijgo/js/gijgo.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<i class="fas fa-calendar-alt"></i>'
                }
            });
            $('.datepicker2').datepicker({
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<i class="fas fa-calendar-alt"></i>'
                }
            });
        });
    </script>
@endpush
 