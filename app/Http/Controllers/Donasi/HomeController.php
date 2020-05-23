<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\AktivitasDonasi;
use App\Donasi;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AktivitasDonasi::with(['info_posko.jenis_bencana','info_posko.user'])->get();
        // foreach($items as $item){
        //    $donasi =  Donasi::with('aktivitasdonasi')->where('id_aktivitas_donasi',$item->id_aktivitas_donasi)->get();
        //    foreach($donasi as $d){
        //         $donatur = Donasi::with('aktivitasdonasi')->findOrfail($d->id_donasi);
        //    }
            return view('pages.donasi.home',[
                'items'=>$items,
                // 'donatur'=> $donatur
            ]);
        
        
    }

    public function bantuan()
    {
     
            return view('pages.donasi.bantuan');
        
        
    }
}
