@extends('layouts.logistik.logistik')
@section('title','Verifikasi Barang')
    
@section('content')

   <!-- Begin Page Content -->
<div class="container-fluid">
  @if (session('tambah'))
  <div class="alert alert-success" role="alert">
      {{session('tambah')}}
    </div>    
  @endif
  @if (session('hapus'))
  <div class="alert alert-success" role="alert">
      {{session('hapus')}}
    </div>    
  @endif
    
    <h5 >Silahkan lakukan penginputan</h5>
<form action="{{route('tambah-barang', $donasi)}}" method="post">
      @csrf
    <table class="table table-responsive table-borderless">
      <thead>
        <tr>
          <th>Nama Barang</th>
          <th>Quantity</th>
          <th><button type="submit" id="tambah" class="btn btn-sm btn-success mt-3"><i
            class="fas fa-plus"> Tambah</i></button></th>
        </tr>
      </thead>
    
             
      <tbody>
        <tr>
            <td>  <select class="form-control form-control-sm @error('id_stok_barang') is-invalid @enderror" id="id_stok_barang"
                    name="id_stok_barang">
                    <option >Silahkan pilih</option>
                    @foreach ($stokbarang as $stok)
                        <option value="{{$stok->id_stok_barang}}">{{$stok->nama_barang}}</option>    
                  @endforeach
              </select>
              @error ('id_stok_barang')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
        </td>

            <td>
              <input type="number" class="form-control form-control-sm @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah">
              @error ('jumlah')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
              @enderror
            </td>

        </tr>
      </tbody>
    </table>

                   
                </form>

                
      <table class="table-responsive table-striped table-borderless text-center mb-5" cellpadding="15">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Satuan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              @if ($items->count() > 0)
              @foreach ($items as $item)
              <tr>
              <td class="align-middle">{{$item->id_stok_barang}}</td>
                <td class="align-middle">{{$item->stokbarang->nama_barang}}</td>
                <td class="align-middle">{{$item->jumlah}}</td>
                <td class="align-middle">{{$item->stokbarang->satuan}}</td>
                <td class="align-middle"><a href="{{route('hapus-barang', $item->id_barang_masuk)}}" onclick="return confirm('Apakah data ingin dihapus?');" class="btn btn-sm btn-danger"><i
                    class="fas fa-trash">
                    Hapus</i></a></td>
              </tr>
              @endforeach
              @else
                 <tr>
                     <td colspan="5" >data kosong</td>
                </tr> 

              @endif

              
          </tbody>
      </table>
       


            
      <div class="col-10 offset-1">
 

            <a href="{{route('verifikasi-sukses',$donasi)}}" onclick="return confirm('Apakah anda yakin data sudah benar?');" class="btn btn-block btn-success" >Submit</a>
     
      </div>
          
     
        

</div>
<!-- /.container-fluid -->

@endsection
    

   
