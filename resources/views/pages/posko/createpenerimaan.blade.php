@extends('layouts.posko.posko')
@section('title','Buat Laporan Penerimaan')

@section('content')
  
      <!-- Begin Page Content -->
      <div class="container-fluid ">
        @if ($errors->any())
        <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{$error}}</li>
                 @endforeach
             </ul>
        </div>       
        @endif
       
    <h5 class="mb-5">Silahkan Buat Laporan Penerimaan Barang</h5>
    <form action="{{route('store', [$id_permintaan,$id_penerimaan])}}" method="post">
          @csrf
    <div class="col-auto col-md-6">
        @foreach ($id_pengiriman as $id)
        <label for="id_pengiriman_barang">ID Pengiriman Barang</label>
        <input value="{{$id->id_pengiriman_barang}}" type="text" class="form-control form-control-sm" readonly id="id_pengiriman_barang" name="id_pengiriman_barang">
      
        <label class="mt-2" for="tanggal_pengiriman">Tanggal Pengiriman Barang</label>
        <input type="text" value="{{Carbon\Carbon::create($id->tanggal_pengiriman)->format('d - m - Y')}}" class="form-control form-control-sm" readonly id="tanggal_pengiriman" name="tanggal_pengiriman">
  
        @endforeach
        <label class="mt-2" for="tanggal_penerimaan">Tanggal Penerimaan Barang</label>
        <input type="date" class="form-control form-control-sm"  id="tanggal_penerimaan" name="tanggal_penerimaan">
      
    <div class="form-group"> 
            <label for="keterangan_penerimaan" class="mt-2">Keterangan penerimaan</label>
            <textarea class="form-control mb-4" required placeholder="Masukkan keterangan" cols="30" rows="3" name="keterangan_penerimaan" id="keterangan_penerimaan"></textarea>
        
        </div>
    </div>

    <h5 class="mb-3">Silahkan Pilih Barang Yang Diterima</h5>

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
                  <input type="number" class="form-control form-control-sm " id="jumlah" name="jumlah[]">
                 
                </td>
    
            </tr>

            
          </tbody>
        </table>   

        <div id="insert-form"></div>
        
        
        <button type="submit" onclick="return confirm('Pastikan Data Sudah Benar!');" class="btn btn-primary btn-block">Kirim</button>
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
            ' <input type="number" class="form-control form-control-sm " id="jumlah" name="jumlah[]">'+
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
