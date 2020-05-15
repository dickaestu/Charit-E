<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapPermintaanLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.admin.laporanpermintaanlogistik');
    }

    public function getpermintaan()
    {
       return \DataTables::eloquent(PermintaanBarang::with(['infoposko'])->select('permintaan_barang.*')->where('status_permintaan','VERIFIED'))
       ->editColumn('tanggal_permintaan',function($d){
        return Carbon::create($d->tanggal_permintaan)->format('d-m-Y');
       })
       ->editColumn('status_penerimaan',function($d){
        return $d->status_penerimaan ?' Diterima' : 'Belum Diterima';
       })
       ->addColumn('detail_permintaan',function($d){
        return '<a href="/admin/data-permintaan/detail/'.$d->id_permintaan_barang.'" class="btn btn-sm btn-info">Detail</a>';
       })
       ->rawColumns(['tanggal_permintaan','status_pengiriman','status_penerimaan','detail_permintaan'])
       ->toJson();
    }

    public function export()
    {
        $items = PermintaanBarang::with('infoposko')->get();
        $pdf = PDF::loadView('exports.admin.permintaan-logistik',['items'=>$items]);
        return $pdf->download('permintaan-logistik.pdf');

    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from);
        $endDate   = Carbon::create($request->to)->addDays(1) ;
        $items = PermintaanBarang::with('infoposko')->whereBetween('created_at',[$startDate,$endDate])->get();
        $pdf = PDF::loadView('exports.admin.permintaan-logistik',['items'=>$items]);
        return $pdf->download('permintaan-logistik.pdf');

    }

    public function exportDetail($id)
    {
        $items = DetailPermintaanBarang::where('id_permintaan_barang',$id)->get();
        $permintaan = PermintaanBarang::findOrFail($id);
        $pdf = PDF::loadView('exports.admin.detail.detail-permintaan-logistik',['items'=>$items,'permintaan'=>$permintaan]);
        return $pdf->download('detail-permintaan-logistik.pdf');

    }
}
