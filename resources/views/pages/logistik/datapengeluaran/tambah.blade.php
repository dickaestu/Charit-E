@extends('layouts.logistik.logistik')
@section('title','Tambah Pengeluaran')
    
@section('content')

   <!-- Begin Page Content -->
<div class="container-fluid">
  
 
  
  <h5 class="mb-3">Silahkan Masukkan Barang Yang Dibeli</h5>
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
  <div class="alert alert-danger" role="alert">
      {{session('error')}}
    </div>    
  @endif
  
    <div class="card p-3">
    <form action="{{ route('create-pengeluaran-uang') }}" method="post">
      @csrf

     <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_pengeluaran" class="text-dark">Tanggal Pengeluaran</label>
            <input type="date" class="form-control" name="tanggal_pengeluaran" id="tanggal_pengeluaran" >
          </div>

          <div class="form-group">
            <label for="keterangan_pengeluaran" class="text-dark">Keterangan Pengeluaran</label>
            <textarea class="form-control" name="keterangan_pengeluaran" id="keterangan_pengeluaran" cols="30" rows="6"></textarea>
          </div>
     </div>
      <table class="table table-responsive table-borderless">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Quantity</th>
            <th>Nominal</th>
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
              <input type="number" class="form-control form-control-sm" min="1"  id="jumlah" name="jumlah[]">               
              </td>

              <td>           
                <input type="number" class="form-control form-control-sm" min="0"  id="nominal" name="nominal[]">               
            </td>
        
          </tr>

          
        </tbody>
      </table>   

      <div id="insert-form"></div>
      
      
      <div class="row d-flex justify-content-center mb-5">
          <div class="col-auto col-md-6">
              <button type="submit" onclick="return confirm('Pastikan barang yang dimasukkan sudah benar');" class="btn btn-primary btn-block">Kirim</button>
          </div>
      </div>
</form>   
</div>
        

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
            ' <input type="number" class="form-control form-control-sm " min="0" id="nominal" name="nominal[]">'+
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
   
