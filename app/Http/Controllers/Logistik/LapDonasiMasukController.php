<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use App\AdminModel\JenisBencana;

class LapDonasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_bencana = JenisBencana::all();
        return view('pages.logistik.laporandonasimasuk',[
            'jenis_bencana'=> $jenis_bencana
        ]);
    }

   
}
