@extends('layouts.posko.posko')
@section('title','Tambah Permintaan')

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
       
    <h5 class="mb-5">Silahkan Input Permintaan Barang</h5>
      <form action="{{route('proses-tambah-permintaan', $id_permintaan)}}" method="post">
          @csrf
        <div class="form-group">
            <label for="id_info_posko">Pilih Lokasi Bencana</label>
            <select class="form-control form-control @error('id_info_posko') is-invalid @enderror" id="id_info_posko"
            name="id_info_posko">
            <option >Silahkan Pilih</option>
            @foreach ($infoposko as $posko)
        <option value="{{$posko->id_info_posko}}">Lokasi: {{$posko->lokasi_bencana}} || Bencana: {{$posko->jenis_bencana->nama_bencana}}</option>    
          @endforeach
      </select>
            @error ('id_info_posko')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

    <div class="form-group">
        <label for="keterangan_permintaan">Keterangan Permintaan </label>
        <input type="text" class="form-control form-control-sm @error('keterangan_permintaan') is-invalid @enderror" id="keterangan_permintaan" name="keterangan_permintaan">
        @error ('keterangan_permintaan')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <h5 class="mb-3">Silahkan Pilih Barang Yang Dibutuhkan</h5>

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
        
        
        <button type="submit" onclick="return confirm('Permintaan menyesuaikan dengan ketersedian logistik BPBD');" class="btn btn-primary btn-block">Kirim</button>
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
