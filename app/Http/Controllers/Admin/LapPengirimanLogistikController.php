<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\PengirimanBarang;
use App\LogistikModel\DetailPengirimanBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapPengirimanLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view ('pages.admin.laporanpengirimanlogistik');
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
        return '<a href="/admin/laporan-pengiriman/detail/'.$d->id_pengiriman_barang.'" class="btn btn-sm btn-info">Detail</a>';
       })
       ->rawColumns(['tanggal_pengiriman','name','alamat_posko','nama_bencana','detail_pengiriman'])
       ->toJson();
    }

    public function detailpengiriman($id)
    {
        $info = PengirimanBarang::with('permintaanbarang.infoposko')->findOrFail($id);
        $items = DetailPengirimanBarang::with(['stokbarang'])->where('id_pengiriman_barang', $id)->get();
        return view('pages.admin.detailpengiriman',[
            'items'=>$items,
            'info'=>$info
        ]);
    }

    public function export()
    {
        $items = PengirimanBarang::with('permintaanbarang')->get();
        $pdf = PDF::loadView('exports.admin.pengiriman-logistik',['items'=>$items]);
        return $pdf->download('pengiriman-logistik.pdf');

    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from);
        $endDate   = Carbon::create($request->to)->addDays(1) ;
        $items = PengirimanBarang::with('permintaanbarang')->whereBetween('created_at',[$startDate,$endDate])->get();
        $pdf = PDF::loadView('exports.admin.pengiriman-logistik',['items'=>$items]);
        return $pdf->download('pengiriman-logistik.pdf');

    }

    public function exportDetail($id)
    {
        $items = DetailPengirimanBarang::where('id_pengiriman_barang',$id)->get();
        $pengiriman = PengirimanBarang::findOrFail($id);
        $pdf = PDF::loadView('exports.admin.detail.detail-pengiriman-logistik',['items'=>$items,'pengiriman'=>$pengiriman]);
        return $pdf->download('detail-pengiriman-logistik.pdf');

    }
  
}
