@extends('layouts.posko.posko')
@section('title','Edit Info Posko')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid ">
    <h3>Edit Info Posko</h3>

    <div class="col-10 offset-1 mt-4 border rounded">
    <form class="my-3" action="{{route('info-posko.update', $item->id_info_posko)}}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="tanggal_kejadian">Tanggal Kejadian</label>
                <div class="input-group mb-2 mr-sm-2">
                    <input required type="date" name="tanggal_kejadian" class="form-control @error('tanggal_kejadian') is-invalid @enderror" id="tanggal_kejadian"
                value="{{$item->tanggal_kejadian}}">
                </div>
                @error ('tanggal_kejadian')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        <div class="form-group">
            <label for="alamat_posko">Alamat Posko</label>
             <input type="text" class="form-control @error('alamat_posko') is-invalid @enderror" name="alamat_posko" placeholder="Masukkan Alamat Posko" required value="{{$item->alamat_posko}}">
             @error ('alamat_posko')
             <div class="invalid-feedback">
                 {{$message}}
             </div>
             @enderror
          </div>
        <div class="form-group">
            <label for="id_jenis_bencana">Jenis Bencana</label>
            <select name="id_jenis_bencana" required class="form-control @error('id_jenis_bencana') is-invalid @enderror">
            @foreach ($jenis_bencana as $bencana)
                <option {{ $bencana->id_jenis_bencana == $item->id_jenis_bencana ? "selected" : "" }} 
                    value="{{$bencana->id_jenis_bencana}}"> {{$bencana->nama_bencana}}
                </option>
            @endforeach
            </select>
            @error ('id_jenis_bencana')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="lokasi_bencana">Lokasi Bencana</label>
             <input type="text" class="form-control @error('lokasi_bencana') is-invalid @enderror" required name="lokasi_bencana" placeholder="Masukkan Lokasi Bencana" Value="{{$item->lokasi_bencana}}">
             @error ('lokasi_bencana')
             <div class="invalid-feedback">
                 {{$message}}
             </div>
             @enderror
          </div>

        <div class="form-group">
            <label for="jumlah_korban">Jumlah Korban</label>
             <input type="number" class="form-control @error('jumlah_korban') is-invalid @enderror" required name="jumlah_korban" placeholder="Masukkan Jumlah Korban" Value="{{$item->jumlah_korban}}">
             @error ('jumlah_korban')
             <div class="invalid-feedback">
                 {{$message}}
             </div>
             @enderror
          </div>

        <div class="form-group">
            <label for="jumlah_korban_jiwa">Jumlah Korban Jiwa</label>
             <input type="number" class="form-control @error('jumlah_korban_jiwa') is-invalid @enderror" required name="jumlah_korban_jiwa" placeholder="Masukkan Jumlah Korban Jiwa" Value="{{$item->jumlah_korban_jiwa}}">
             @error ('jumlah_korban_jiwa')
             <div class="invalid-feedback">
                 {{$message}}
             </div>
             @enderror
          </div>


        <div class="col col-md-6 offset-md-3 mt-4">
          <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin ingin mengubah data?');">Ubah</button>
        </div>
      </form>

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

   
@endpush


