@extends('layouts.admin.admin')
@section('title','Detail Sub Posko')

@section('content')
  
      <!-- Begin Page Content -->
      <div class="container-fluid ">
     
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Sub Posko</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Posko</th>
                                <th>Nama Penanggung Jawab</th>
                           
                            </tr>
                        </thead>
                        <tbody>
              
                        @forelse ($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_sub_posko}}</td>
                            <td>{{$item->nama_penanggung_jawab}}</td>
                        
                        </tr>
                        @empty
                            
                        <tr>
                            <td colspan="3" class="text-center">Data Kosong</td>
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
