@extends('layouts.logistik.logistik')
@section('title','Donasi Masuk')
@push('addon-style')
<!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>    
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Donasi Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Donasi</th>
                            <th>Tanggal Donasi</th>
                            <th>Nama</th>

                            <th>Jenis Donasi</th>
                            <th>keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse ($items as $item)
                      <tr>
                        <td>{{$item->id_donasi}}</td>
                        <td>{{Carbon\Carbon::create($item->tanggal_donasi)->format('d - m - Y')}}</td>
                        <td>{{$item->user->name}}</td>

                        <td>{{$item->jenis_donasi}}</td>
                        <td>{{$item->keterangan_donasi}}</td>
                        <td class="{{$item->status_verifikasi ? 'text-success' : 'text-muted'}}">{{$item->status_verifikasi ? 'Verified' : 'Pending'}}</td>
                        <td>
                            @if ($item->status_verifikasi==false)
                            @if ($item->jenis_donasi == 'pokok')
                            <a  href="{{route('verifikasi-barang',$item->id_donasi)}}"
                                class="btn btn-success btn-sm">Verifikasi</a>
                            @else
                            <a  href="{{route('verifikasi-uang',$item->id_donasi)}}"
                                class="btn btn-success btn-sm">Verifikasi</a>
                            @endif
                            @else
                            <button disabled class="btn btn-secondary btn-sm">Verifikasi</button>
                            @endif
                            
                            <a target="_blank" href="{{Storage::url($item->foto_bukti)}}" name="hapus" id="hapus">Lihat
                                Foto</a>
                        </td>
                    </tr>
                      @empty
                          <tr>
                              <td colspan="7" class="text-center">Data Kosong</td>
                          </tr>
                      @endforelse

                  </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
    

    @push('addon-script')

       <!-- Page level plugins -->
       <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
       <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
   
       <!-- Page level custom scripts -->
       <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>
    <script>
        $(function () {
            $('#jenisdonasi').change(function () {
                $('.optionBox').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
    @endpush
