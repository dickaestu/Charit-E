@extends('layouts.logistik.logistik')
@section('title','Transaksi Pemasukan')
    
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid ">
        <h3>Transaksi Pemasukan</h3>


        <section class="mt-5">
            <form action="" name="">

                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="jenisdonasi">Jenis Donasi</label>
                        <select class="form-control" id="jenisdonasi" name="jenisdonasi">
                            <option>Pilih Jenis Donasi</option>
                            <option value="pokok">Kebutuhan Pokok</option>
                            <option value="uang">Uang</option>
                        </select>
                    </div>
                </div>


                <!-- Input Kebutuhan Pokok -->
                <div id="pokok" style="display:none" class="optionBox">
                    <!-- Isi Dari Kebutuhan Pokok -->
                    <div class="row justify-content-end">
                        <div class="col-6 ">
                            <button name="tambah" id="tambah" class="btn btn-sm btn-success mb-3"><i
                                    class="fas fa-plus">
                                    Tambah</i></button>
                        </div>

                    </div>
                    <div class="row border-bottom">
                        <div class="col-auto col-md-2 ml-2">
                            <div class="form-group">
                                <label for="namaPokok">Jenis</label>
                                <select class="form-control form-control-sm" id="namaPokok"
                                    name="namaPokok">
                                    <option>Makanan</option>
                                    <option>Minuman</option>
                                    <option>Pakaian</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto col-md-2">
                            <div class="form-group">
                                <label for="namaKebutuhan">Nama</label>
                                <select class="form-control form-control-sm" id="namaKebutuhan"
                                    name="namaKebutuhan">
                                    <option>Baju Pria</option>
                                    <option>Baju Wanita</option>
                                    <option>Baju</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3 col-md-1 ml-1">
                            <div class="form-group">
                                <label for="qty">qty</label>
                                <input type="number" class="form-control form-control-sm" id="qty"
                                    name="qty">
                            </div>
                        </div>

                        <div class="col-auto col-md-1">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control form-control-sm" id="satuan" name="satuan">
                                    <option>dus</option>
                                    <option>sak</option>
                                    <option>unit</option>
                                    <option>pak</option>
                                    <option>buah</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-2 d-block align-self-center">
                            <button name="tambah" id="tambah" class="btn btn-sm btn-danger mt-3"><i
                                    class="fas fa-trash">
                                    Hapus</i></button>
                        </div>
                    </div>
                </div>
                <!-- Akhir Dari Kebutuhan Pokok -->

                <!-- Input Donasi Uang -->
                <div id="uang" style="display:none" class=" optionBox">
                    <div class="col col-md-5">
                        <div class="form-group">
                            <label for="nominal">Silahkan Input Nominal</label>
                            <input type="number" class="form-control" id="nominal"
                                aria-describedby="nominal">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <button type="button" class="btn btn-primary mt-5">Konfirmasi</button>
                </div>
            </form>
        </section>


    </div>
    <!-- /.container-fluid -->


@endsection
     
@push('addon-script')
<script>
    $(function () {
        $('#jenisdonasi').change(function () {
            $('.optionBox').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>
@endpush
 