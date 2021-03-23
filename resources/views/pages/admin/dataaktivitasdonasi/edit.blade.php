@extends('layouts.admin.admin')
@section('title','Edit Aktivitas Donasi')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid ">
    <h3>Edit Aktivitas Donasi</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
             @endforeach
         </ul>
    </div>       
    @endif
    <div class="col-10 offset-1 mt-4 border rounded">
    <form class="my-3" action="{{route('data-aktivitas.update', $item->id_aktivitas_donasi)}}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          
          
        
          <div class="form-group">
            <label for="foto_aktivitas">Foto Aktivitas</label>
            <input  type="file" name="foto_aktivitas" id="foto_aktivitas" class="form-control @error('foto_aktivitas') is-invalid @enderror" placeholder="foto_aktivitas">
            @error ('foto_aktivitas')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
          </div>

        <div class="form-group">
            <label for="keterangan_aktivitas">Keterangan</label>
        <textarea name="keterangan_aktivitas" class="form-control @error('keterangan_aktivitas') is-invalid @enderror" id="keterangan_aktivitas" rows="3">{{$item->keterangan_aktivitas}}</textarea>
        @error ('keterangan_aktivitas')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror   
      </div>

        <div class="col col-md-6 offset-md-3 mt-4">
          <button type="submit" class="btn btn-success btn-block" >Ubah</button>
        </div>
      </form>

    </div>


  </div>
  <!-- /.container-fluid -->


  

@endsection


