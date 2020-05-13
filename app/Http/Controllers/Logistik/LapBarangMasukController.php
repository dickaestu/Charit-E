<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\BarangMasuk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.logistik.laporanbarangmasuk');
    }

    public function getbarangmasuk()
    {
       return \DataTables::eloquent(BarangMasuk::with(['donasi'])->select('barang_masuk.*'))
       ->editColumn('tanggal_masuk',function($d){
        return Carbon::create($d->tanggal_barang_masuk)->format('d-m-Y');
       })
       ->editColumn('name',function($d){
        return $d->donasi->nama_donatur;
       })   
       ->editColumn('nama_barang',function($d){
        return $d->stokbarang->nama_barang;
       }) 
       ->editColumn('satuan_barang',function($d){
        return $d->stokbarang->satuan;
       }) 
       ->rawColumns(['tanggal_masuk','name','nama_barang','satuan_barang'])
       ->toJson();
    }

    public function export()
    {
        $items = BarangMasuk::with(['donasi','stokbarang'])->get();
        $pdf = PDF::loadView('exports.logistik.barangmasuk',['items'=>$items]);
        return $pdf->download('barangmasuk.pdf');

    }

    public function exportBulan(Request $request)
    {
        $startDate =  Carbon::create($request->from);
        $endDate   = Carbon::create($request->to)->addDays(1) ;
        $items = BarangMasuk::with(['donasi','stokbarang'])->whereBetween('created_at',[$startDate,$endDate])->get();
        $pdf = PDF::loadView('exports.logistik.barangmasuk',['items'=>$items]);
        return $pdf->download('barangmasuk.pdf');

    }
}
