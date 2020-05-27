<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\PengeluaranUang;
use App\LogistikModel\DetailPengeluaranUang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
class LapPengeluaranUangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view ('pages.logistik.laporanpengeluaran');
    }
    public function getpengeluaran()
    {
       return \DataTables::eloquent(PengeluaranUang::select('pengeluaran_uang.*'))
       ->editColumn('tanggal_pengeluaran',function($d){
        return Carbon::create($d->tanggal_pengeluaran)->format('d-m-Y');
       })
       ->editColumn('total_pengeluaran',function($d){
        return 'Rp. '.number_format($d->total_pengeluaran, 0,',','.');
       }) 
       ->addColumn('detail_pengeluaran',function($d){
        return '<a href="/logistik/export-detail-pengeluaran/'.$d->id_pengeluaran_uang.'" class="btn btn-sm btn-info">Print Detail</a>';
       })
       ->rawColumns(['tanggal_pengeluaran','detail_pengeluaran'])
       ->toJson();
    }

    public function export()
    {
        $items = PengeluaranUang::all();
        $total= PengeluaranUang::sum('total_pengeluaran');
        $pdf = PDF::loadView('exports.logistik.pengeluaran-uang-logistik',compact('items','total'));
        return $pdf->download('pengeluaran-uang.pdf');

    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $items = PengeluaranUang::whereBetween('tanggal_pengeluaran',[$startDate,$endDate])->get();
        $total = PengeluaranUang::whereBetween('tanggal_pengeluaran',[$startDate,$endDate])->sum('total_pengeluaran');
        $pdf = PDF::loadView('exports.logistik.pengeluaran-uang-logistik-bulanan',[
            'items'=>$items,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'total'=>$total
            ]);
        return $pdf->download('pengeluaran-uang-logistik.pdf');

    }

    public function exportDetail($id)
    {
        $items = DetailPengeluaranUang::with('stokbarang')->where('id_pengeluaran_uang',$id)->get();
        $total = DetailPengeluaranUang::with('stokbarang')->where('id_pengeluaran_uang',$id)->sum('nominal');
        $pengeluaran = PengeluaranUang::findOrFail($id);
        $pdf = PDF::loadView('exports.logistik.detail.detail-pengeluaran-uang-logistik',
        ['items'=>$items,'pengeluaran'=>$pengeluaran,'total'=>$total]);
        return $pdf->download('detail-pengeluaran-uang.pdf');

    }
}
