<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\BarangMasuk;

class DataBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = BarangMasuk::with(['donasi.user','stokbarang'])->get();

        return view('pages.logistik.databarangmasuk',[
            'items'=>$items
        ]);
    }

  

}
