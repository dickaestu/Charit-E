<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\UangMasuk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapDataUangDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = UangMasuk::with(['donasi'])->get();
        return view ('pages.admin.laporandatauangdonasi',[
           'items'=> $items
        ]);
    }

    public function getdatauang()
    {
       return \DataTables::eloquent(UangMasuk::with(['donasi'])->select('uang_masuk.*'))
       ->editColumn('tanggal_masuk',function($d){
        return Carbon::create($d->tanggal_masuk)->format('d-m-Y');
       })
       ->editColumn('name',function($d){
        return $d->donasi->nama_donatur;
       })   
       ->editColumn('nominal',function($d){
        return 'Rp. '.number_format($d->nominal, 0,',','.');
       }) 
       ->rawColumns(['tanggal_masuk','name','nominal'])
       ->toJson();
    }

    public function export()
    {
        $items = UangMasuk::with('donasi')->get();
        $pdf = PDF::loadView('exports.admin.uangmasuk',['items'=>$items]);
        return $pdf->download('uangmasuk.pdf');

    }

    public function exportBulan(Request $request)
    {
        $startDate =  Carbon::create($request->from);
        $endDate   = Carbon::create($request->to)->addDays(1) ;
        $items = UangMasuk::with('donasi')->whereBetween('created_at',[$startDate,$endDate])->get();
        $pdf = PDF::loadView('exports.admin.uangmasuk',['items'=>$items]);
        return $pdf->download('uangmasuk(bulanan).pdf');

    }

    
}
