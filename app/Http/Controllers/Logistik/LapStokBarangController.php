<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use App\LogistikModel\DetailBarangMasuk;
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
        $items = StokBarang::all();
        return view('pages.logistik.laporanstokbarang', compact('items'));
    }

    public function getstokbarang()
    {
        return \DataTables::eloquent(StokBarang::select('stok_barang.*'))
            ->toJson();
    }

    public function export()
    {
        $items = StokBarang::all();
        $pdf = PDF::loadView('exports.logistik.stokbarang', ['items' => $items])->setPaper('a4', 'landscape');
        // return $pdf->download('stok_barang.pdf');
        return $pdf->stream();
    }

    public function exportJenisBarang($id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        $items = DetailBarangMasuk::where('id_stok_barang', $id)->get();
        $pdf = PDF::loadView('exports.logistik.laporan-jenis-barang', ['items' => $items, 'stokBarang' => $stokBarang])->setPaper('a4', 'portrait');
        // return $pdf->download('stok_barang.pdf');
        return $pdf->stream();
    }
}
