@extends('layouts.donasi.donasi')
@section('title','Riwayat Donasi')

@section('content')
    
    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg-3">
        <div class="container">
            <div class="page-title-content">
                <h2>Riwayat Donasi</h2>
                <ul>
                    <li>
                        <a href="{{route('home')}}">
                            Home
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </li>
                    <li>Riwayat Donasi</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Riwayat Donasi Area -->
    <section class="active-campaing-area">
        
    
    <div class="container">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered" id="table_riwayat" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    
                        <th>Tanggal Donasi</th>
                        <th>ID Donasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                   
                   
                    @foreach ($items as $item)
                    <tr>
                        <td>{{Carbon\Carbon::create($item->tanggal_donasi)->format('d - m - Y')}}</td>
                        <td>{{$item->id_donasi}}</td>
                        <td>{{$item->keterangan_donasi}}</td>
                         <td class="{{$item->status_verifikasi ? 'text-success' : 'text-muted'}}">
                            {{$item->status_verifikasi ? 'Verified' : 'Pending'}}
                        </td>
                    </tr>
                    @endforeach

                  
                      
                

                  

                </tbody>
            </table>
        </div>
   </div>    
    </div>      
            
                
    
                  
                       
                
          

      
    </section>
    <!-- End Riwayat Donasi Area -->




@endsection



