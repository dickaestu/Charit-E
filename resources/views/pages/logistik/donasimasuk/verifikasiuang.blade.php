@extends('layouts.logistik.logistik')
@section('title','Verifikasi Uang')
    
@section('content')

   <!-- Begin Page Content -->
<div class="container-fluid">
        <!-- Verif Modal -->
       
       
    <h5 >Silahkan lakukan verifikasi</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>ID Donasi : <span>{{$item->id_donasi}}</span></p>
                    <p>Nama Donatur : <span>{{$item->user->name}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center mt-5">
 
        
        <div class="card">
            <div class="card-body">
            <form action="{{route('verifikasi-uangcreate', $item->id_donasi)}}" method="post">
                    @csrf

                    <div class="form-group">
                             <label for="nominal">Silahkan Input Nominal</label>
                             <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal">
                             @error ('nominal')
                             <div class="invalid-feedback">
                                 {{$message}}
                             </div>
                             @enderror
                            </div>
  
                  
                    <button  type="submit" class="btn btn-block btn-success" onclick="return confirm('Apakah anda yakin data sudah benar?');" >Submit</button>
               
                </form>           
            </div>
        </div>  
    </div>
    
     
        

    </div>

<!-- /.container-fluid -->

@endsection
    

    @push('addon-script')
    <script>
        $(function () {
            $('#jenisdonasi').change(function () {
                $('.optionBox').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
    @endpush
