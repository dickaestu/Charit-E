<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;

class DataPermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PermintaanBarang::with(['infoposko'])->where('status_permintaan', 'VERIFIED')->where('status_pengiriman', false)->get();
        return view('pages.logistik.datapermintaan.index',[
            'items'=>$items
        ]);
    }

    public function detailpermintaan($id)
    {
        $info = PermintaanBarang::findOrFail($id);
        $items = DetailPermintaanBarang::with(['stokbarang'])->where('id_permintaan_barang', $id)->get();
  
        return view('pages.logistik.datapermintaan.detailpermintaan',[
            'items'=>$items,
            'info'=>$info,
          
        ]);
    }

    
}
