<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class DonasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Donasi::with(['user'])->get();
        return view('pages.admin.laporandonasimasuk',[
            'items'=> $items
        ]);
    }

    public function getdatadonasi()
    {
       return \DataTables::eloquent(Donasi::with(['aktivitasdonasi'])->select('donasi.*')->where('status_verifikasi',true))
       ->editColumn('tanggal_donasi',function($d){
        return Carbon::create($d->tanggal_donasi)->format('d-m-Y');
       })
       ->editColumn('status_verifikasi',function($d){
        return $d->status_verifikasi ?'<font class="text-success"> Verified </font>' : 'Pending';
       })
       ->editColumn('lokasi_bencana',function($d){
        return $d->aktivitasdonasi->info_posko->lokasi_bencana;
       })
       ->rawColumns(['tanggal_donasi','status_verifikasi','lokasi_bencana'])
       ->toJson();
    }

    public function export()
    {
        $donasi = Donasi::where('status_verifikasi',true)->get();
        $pdf = PDF::loadView('exports.admin.donasimasuk',['items'=>$donasi]);
        return $pdf->download('donasimasuk.pdf');

    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from);
        $endDate   = Carbon::create($request->to)->addDays(1) ;
        $donasi = Donasi::where('status_verifikasi',true)->whereBetween('created_at',[$startDate,$endDate])->get();
        $pdf = PDF::loadView('exports.admin.donasimasuk',['items'=>$donasi]);
        return $pdf->download('donasimasuk.pdf');

    }

   
}
