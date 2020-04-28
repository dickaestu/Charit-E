@extends('layouts.admin.admin')
@section('title','Data User')

@push('addon-style')
    <!-- Custom styles for this page -->
<link href="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
     </ul>
</div>       
@endif
<div class="container-fluid">  
    @if (session('sukses'))
    <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>    
    @endif

    @if (session('dihapus'))
    <div class="alert alert-success" role="alert">
        {{session('dihapus')}}
      </div>    
    @endif

    @if (session('edit'))
    <div class="alert alert-success" role="alert">
        {{session('edit')}}
      </div>    
    @endif

    
    <!-- Page Heading -->

    <button data-toggle="modal" data-target="#modalTambah" class="btn btn-success mb-3" name="tambah" id="tambah">Tambah</button>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Nama</th>
                            <th>Email</th>
                        
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{$item->user_id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->role}}</td>
                            <td>
                                <a  href="{{route('data-user.edit', $item->user_id)}}"
                                    class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{route('data-user.destroy',$item->user_id)}}" method="post">
                                @csrf
                                @method('delete')
                                    <button name="hapus" id="hapus"
                                    class="btn btn-danger btn-sm mt-2" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">Hapus</button>
                                </form>
                                
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!--  Tambah Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('data-user.store')}}" method="POST">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nama" placeholder="Masukkan Nama" value ="{{old('name')}}">
                    @error ('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value ="{{old('email')}}">
                    @error ('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error ('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password-confirmation">
                </div>

                <div class="form-group">
                    <label for="role">Pilih Role</label>
                    <select class="form-control" name="role" id="role">
                    <option value="ADMIN">ADMIN</option>
                    <option value="DONATUR">DONATUR</option>
                    <option value="LOGISTIK">LOGISTIK</option>
                    <option value="POSKO">POSKO</option>
                    </select>
                </div>
    
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
        </div>
    </div>


  

@endsection

@push('addon-script')
    <!-- Page level plugins -->
    <script src="{{url('backend_assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('backend_assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('backend_assets/js/demo/datatables-demo.js')}}"></script>

   
@endpush