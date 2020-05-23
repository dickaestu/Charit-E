<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\AktivitasDonasi;
use App\PoskoModel\PenerimaanBarang;
use App\LogistikModel\PengirimanBarang;
use App\PoskoModel\DetailPenerimaanBarang;
use App\PoskoModel\PermintaanBarang;
use App\Donasi;

class DetailDonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $item = AktivitasDonasi::findOrFail($id);
        $uang = Donasi::with('aktivitasdonasi')->where('status_verifikasi', true)
        ->where('id_aktivitas_donasi', $id)->where('jenis_donasi', 'uang')->get();
        $barang = Donasi::with('aktivitasdonasi')->where('status_verifikasi', true)
        ->where('id_aktivitas_donasi', $id)->where('jenis_donasi', 'pokok')->get();
        $permintaan = PermintaanBarang::with('pengirimanbarang.detailpengirimanbarang')
        ->where('id_info_posko',$item->id_info_posko)->where('status_pengiriman',true)->get();
     
      // foreach($permintaan as $req){

      //     $pengiriman = PengirimanBarang::with('detailpengirimanbarang')
      //     ->where('id_permintaan_barang',$req->id_permintaan_barang)->get();
      
      //   }

            return view('pages.donasi.detaildonatur',[  
                'item'=> $item,
                'uang'=>$uang,
                'barang'=> $barang,
              'permintaan'=>$permintaan,
            ]);
     
        
    }

   
}
