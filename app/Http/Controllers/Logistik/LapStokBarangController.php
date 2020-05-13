<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\StokBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapStokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.logistik.laporanstokbarang');
    }

    public function getstokbarang()
    {
       return \DataTables::eloquent(StokBarang::select('stok_barang.*'))
       ->toJson();
    }

    public function export()
    {
        $items = StokBarang::all();
        $pdf = PDF::loadView('exports.logistik.stokbarang',['items'=>$items]);
        return $pdf->download('stok_barang.pdf');

    }
}
