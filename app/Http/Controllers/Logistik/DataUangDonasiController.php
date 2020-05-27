<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\UangMasuk;
use App\LogistikModel\PengeluaranUang;

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
        $total_masuk = UangMasuk::sum('nominal');
        $total_keluar = PengeluaranUang::sum('total_pengeluaran');
        $total = $total_masuk - $total_keluar;
        return view('pages.logistik.datauangdonasi',[
            'items'=> $items,
            'total'=>$total
        ]);
    }

   
}
