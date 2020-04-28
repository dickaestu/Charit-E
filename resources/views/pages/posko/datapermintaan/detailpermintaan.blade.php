@extends('layouts.posko.posko')
@section('title','Detail Permintaan')

@section('content')
  
      <!-- Begin Page Content -->
      <div class="container-fluid ">

      
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Permintaan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>

                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($items as $item )    
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->stokbarang->nama_barang}} / {{$item->stokbarang->satuan}}</td>
                                    <td>{{$item->jumlah}}</td>        
                                </tr>
                              
                            @endforeach
                      
                        

                        



                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->
@endsection
