<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use App\LogistikModel\BarangMasuk;
use App\LogistikModel\UangMasuk;
use App\PoskoModel\PermintaanBarang;
use App\LogistikModel\DetailPengirimanBarang;
use App\LogistikModel\StokBarang;
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
        $date = Carbon::now()->format('Y-m-d');

        $barang = BarangMasuk::whereDate('tanggal_barang_masuk', $date)->count();
        $pending = Donasi::where('status_verifikasi', false)->count();
        $request_logistik = PermintaanBarang::where('status_permintaan', 'VERIFIED')->where('status_pengiriman', false)->count();
        $stok_barang = [];
        $jumlah = [];
        foreach (StokBarang::all() as $stok) {
            $stok_barang[] = $stok->nama_barang;

            $jumlah[] = (int)DetailPengirimanBarang::where('id_stok_barang', $stok->id_stok_barang)->sum('jumlah');
        }



        return view('pages.logistik.dashboard', [
            'barang' => $barang,
            'pending' => $pending,
            'request_logistik' => $request_logistik,
            'stok_barang' => $stok_barang,
            'jumlah' => $jumlah
        ]);
    }
}
