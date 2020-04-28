@extends('layouts.logistik.logistik')
@section('title','Buat Pengiriman')

@section('content')
  
      <!-- Begin Page Content -->
      <div class="container-fluid ">
          
<div class="row">
    <div class="col-auto col-md-6">
        <h5 class="mb-3">Jumlah Stok Barang Yang Tersedia</h5>
    </div>

    <div class="col-auto col-md-6">
        <h5 class="mb-3">Jumlah Barang Yang Diminta</h5>
    </div>
</div>

<div class="row">
    <div style="height: 150px;" class="overflow-auto mb-5 col-auto col-md-6">
        <ul class="list-group">
            <ul class="list-group">
                @foreach ($stokbarang as $item)
                <li class="list-group-item">{{$item->nama_barang}} <span class="float-right">{{$item->quantity}} {{$item->satuan}}</span></li>
                @endforeach
              </ul>
            
          </ul>
    </div>

    <div style="height: 150px;" class="overflow-auto mb-5 col-auto col-md-6">
        @foreach ($detail as $item)
        <li class="list-group-item">{{$item->stokbarang->nama_barang}} <span class="float-right">{{$item->jumlah}} {{$item->stokbarang->satuan}}</span></li>
        @endforeach
        
    </div>
</div>


<form action="{{route('proses-tambah-pengiriman',[$permintaan->id_permintaan_barang, $id_pengiriman])}}" method="post">
    @csrf
<div class="col-auto col-md-6">
    <label for="keterangan_pengiriman">Keterangan Pengiriman</label>
    <textarea class="form-control mb-4" required placeholder="Masukkan keterangan" cols="30" rows="3" name="keterangan_pengiriman" id="keterangan_permintaan"></textarea>

</div>

    <h5 class="mb-3">Silahkan Pilih Barang Yang Ingin Dikirim</h5>
    @if ($errors->any())
    <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
             @endforeach
         </ul>
    </div>       
    @endif

    @if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}</div>
@endif

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th>Nama Barang</th>
              <th>Quantity</th>
              <th><button type="button" id="tambah" class="btn btn-sm btn-success mt-3"><i
                class="fas fa-plus"> Tambah</i></button></th>
            <th><button type="button" id="reset-btn" class="btn btn-sm btn-danger mt-3"><i
                class="fas fa-trash"> Reset</i></button></th>
            </tr>
          </thead>
        
                 
          <tbody>
            <tr>
                <td>  <select class="form-control form-control-sm " id="id_stok_barang"
                        name="id_stok_barang[]">
                        <option >Silahkan pilih</option>
                        @foreach ($stokbarang as $stok)
                            <option value="{{$stok->id_stok_barang}}">{{$stok->nama_barang}} / {{$stok->satuan}}</option>    
                      @endforeach
                  </select>
                
            </td>
            
                <td>                 
                <input type="number" class="form-control form-control-sm" min="1" max="" id="jumlah" name="jumlah[]">               
                </td>
          
            </tr>

            
          </tbody>
        </table>   

        <div id="insert-form"></div>
        
        
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-auto col-md-6">
                <button type="submit" onclick="return confirm('Pastikan barang yang ingin di kirim sudah sesuai');" class="btn btn-primary btn-block">Kirim</button>
            </div>
        </div>
 </form>

 <!-- textbox untuk menampung jumlah data form -->
 <input type="hidden" id="jumlah-form" value="1">




    </div>
    <!-- /.container-fluid -->
@endsection

@push('addon-script')
<script>
    $(document).ready(function(){
        $("#tambah").click(function(){

            var jumlah = parseInt($("#jumlah-form").val());
            var nextform = jumlah+1;

            $("#insert-form").append(
            '<table class="table table-responsive table-borderless">'+
            '<tr>'+
            '<td><select class="form-control form-control-sm" id="id_stok_barang" name="id_stok_barang[]">'+
            '<option>Silahkan pilih</option>'+
            ' @foreach ($stokbarang as $stok) <option value="{{$stok->id_stok_barang}}">{{$stok->nama_barang}} / {{$stok->satuan}}</option> @endforeach'+
            ' </select>'+
            '</td>'+

            '<td>'+
            ' <input type="number" class="form-control form-control-sm " min="1" id="jumlah" name="jumlah[]">'+
            ' </td>'+
            '<td>'+ 
            '<button type="button" class="btn remove">' +
            '<i class="fas fa-trash-alt text-danger">'+
            '</i>'+
            '</button>'+
            '</td>'+
            '</tr>'+
            '</table>');

            $("$jumlah-form").val(nextform);
        });

        $("#reset-btn").click(function(){
            $("#insert-form").html("");
            $("#jumlah-form").val("1");
        });

        $("#insert-form").on("click", ".remove", function (event) {
        $(this).closest("table").remove();     
    });

    });
</script>
    
@endpush
