@extends('layouts.admin.admin')
@section('title','Data User')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid ">
    <h3>Edit Data {{$item->name}}</h3>

    <div class="col-10 offset-1 mt-4 border rounded">
    <form class="my-3" action="{{route('data-user.update', $item->user_id)}}" method="POST">
          @method('PUT')
          @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="nama" placeholder="Masukkan Nama" value ="{{$item->name}}">
            @error ('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value ="{{$item->email}}">
            @error ('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> --}}

        <div class="form-group">
            <label for="role">Pilih Role</label>
            <select class="form-control" name="role" id="role">
            <option  value="ADMIN" @if ($item->role == 'ADMIN') selected @endif>ADMIN</option>
            <option  value="DONATUR" @if ($item->role == 'DONATUR') selected @endif>DONATUR</option>
            <option  value="LOGISTIK" @if ($item->role == 'LOGISTIK') selected @endif>LOGISTIK</option>
            <option  value="POSKO" @if ($item->role == 'POSKO') selected @endif>POSKO</option>
            </select>
        </div>

        <div class="col col-md-6 offset-md-3 mt-4">
          <button type="submit" class="btn btn-success btn-block" >Konfirmasi</button>
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


