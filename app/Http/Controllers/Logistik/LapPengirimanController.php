<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\PengirimanBarang;
use App\LogistikModel\DetailPengirimanBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
class LapPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view ('pages.logistik.laporanpengiriman');
    }
    public function getpengiriman()
    {
       return \DataTables::eloquent(PengirimanBarang::with(['permintaanbarang'])->select('pengiriman_barang.*'))
       ->editColumn('tanggal_pengiriman',function($d){
        return Carbon::create($d->tanggal_pengiriman)->format('d-m-Y');
       })
       ->editColumn('name',function($d){
        return $d->permintaanbarang->infoposko->user->name;
       })   
       ->editColumn('alamat_posko',function($d){
        return $d->permintaanbarang->infoposko->alamat_posko;
       }) 
       ->editColumn('nama_bencana',function($d){
        return $d->permintaanbarang->infoposko->jenis_bencana->nama_bencana;
       }) 
       ->addColumn('detail_pengiriman',function($d){
        return '<a href="/logistik/export-detail-pengiriman/'.$d->id_pengiriman_barang.'" class="btn btn-sm btn-info">Print Detail</a>';
       })
       ->rawColumns(['tanggal_pengiriman','name','alamat_posko','nama_bencana','detail_pengiriman'])
       ->toJson();
    }

    public function export()
    {
        $items = PengirimanBarang::with('permintaanbarang')->get();
        $pdf = PDF::loadView('exports.logistik.pengiriman-logistik',['items'=>$items]);
        return $pdf->download('pengiriman-logistik.pdf');

    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $items = PengirimanBarang::with('permintaanbarang')->whereBetween('tanggal_pengiriman',[$startDate,$endDate])->get();
        $pdf = PDF::loadView('exports.logistik.pengiriman-logistik-bulanan',[
            'items'=>$items,
            'startDate'=>$startDate,
            'endDate'=>$endDate
            ]);
        return $pdf->download('pengiriman-logistik.pdf');

    }

    public function exportDetail($id)
    {
        $items = DetailPengirimanBarang::where('id_pengiriman_barang',$id)->get();
        $pengiriman = PengirimanBarang::findOrFail($id);
        $pdf = PDF::loadView('exports.logistik.detail.detail-pengiriman-logistik',['items'=>$items,'pengiriman'=>$pengiriman]);
        return $pdf->download('detail-pengiriman-logistik.pdf');

    }
}
