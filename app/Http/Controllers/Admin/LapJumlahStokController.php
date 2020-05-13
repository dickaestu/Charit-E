<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\StokBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapJumlahStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = StokBarang::all();
        return view('pages.admin.laporanjumlahstok',[
            'items'=>$items
        ]);
    }

    public function getstokbarang()
    {
       return \DataTables::eloquent(StokBarang::select('stok_barang.*'))
       ->toJson();
    }

    public function export()
    {
        $items = StokBarang::all();
        $pdf = PDF::loadView('exports.admin.stokbarang',['items'=>$items]);
        return $pdf->download('jumlah_stok_barang.pdf');

    }
}
