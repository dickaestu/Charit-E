<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use App\LogistikModel\BarangMasuk;
use App\LogistikModel\UangMasuk;
use App\PoskoModel\PermintaanBarang;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date= Carbon::now()->format('Y-m-d');

        $barang= BarangMasuk::whereDate('tanggal_barang_masuk',$date)->count();
        $uang= UangMasuk::whereDate('tanggal_masuk',$date)->sum('nominal');
        $pending= Donasi::where('status_verifikasi',false)->count();
        $request_logistik = PermintaanBarang::where('status_permintaan','PENDING')->count();
        return view ('pages.logistik.dashboard',[
            'barang'=> $barang,
            'uang'=>$uang,
            'pending'=>$pending,
            'request_logistik'=>$request_logistik
        ]);
    }

   
}
