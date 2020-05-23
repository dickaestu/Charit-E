<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\UangMasuk;

class DataUangDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $items = UangMasuk::with('donasi.user')->get();

        return view('pages.logistik.datauangdonasi',[
            'items'=> $items
        ]);
    }

   
}
