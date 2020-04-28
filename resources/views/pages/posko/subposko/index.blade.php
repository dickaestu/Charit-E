@extends('layouts.posko.posko')
@section('title','Data Sub Posko')

@section('content')
  
      <!-- Begin Page Content -->
      <div class="container-fluid ">
        @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
          </div>    
        @endif
        @if (session('edit'))
        <div class="alert alert-success" role="alert">
            {{session('edit')}}
          </div>    
        @endif

        @if (session('hapus'))
        <div class="alert alert-success" role="alert">
            {{session('hapus')}}
          </div>    
        @endif

      <a href="{{route('sub-posko.create')}}" 
            class="btn btn-primary mb-3">Tambah</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Daftar Sub Posko</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bencana</th>
                                <th>Lokasi Kejadian</th>
                                <th>Tanggal Kejadian</th>
                                <th>Nama Posko</th>
                                <th>Nama Penanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        @foreach ($items as $item)
                        @foreach ($infoposko as $info)
                        @if ($item->id_info_posko == $info->id_info_posko)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->info_posko->jenis_bencana->nama_bencana}}</td>
                            <td>{{$item->info_posko->lokasi_bencana}}</td>
                            <td>{{$item->info_posko->tanggal_kejadian}}</td>
                            <td>{{$item->nama_sub_posko}}</td>
                            <td>{{$item->nama_penanggung_jawab}}</td>
                            <td>
                                <a  href="{{route('sub-posko.edit', $item->id_sub_posko)}}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{route('sub-posko.destroy',$item->id_sub_posko)}}" method="post">
                                        @csrf
                                        @method('delete')
                                       
                                            <button name="hapus" id="hapus" 
                                            class="btn btn-danger btn-sm mt-2" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>
                                           
                                    </form>
                            </td>
                        </tr>
                    
                    
                        

                        @endif
                            
                        @endforeach
                       
                       
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->
@endsection
