<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use App\AdminModel\AktivitasDonasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\AdminModel\JenisBencana;
use PDF;
use App\PoskoModel\InfoPosko;

class LapAktivitasDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_bencana = JenisBencana::withTrashed()->get();
        return view ('pages.admin.laporanaktivitasdonasi',[
            'jenis_bencana'=>$jenis_bencana,
        ]);
    }

  
    public function getdataaktivitas()
    {
       return \DataTables::eloquent(AktivitasDonasi::with(['info_posko.jenis_bencana','info_posko.user','donasi'])->withTrashed()->select('aktivitas_donasi.*'))
       ->editColumn('tanggal_kejadian',function($d){
        return Carbon::create($d->info_posko->tanggal_kejadian)->format('d-m-Y');
       })
       ->editColumn('name',function($d){
        return $d->info_posko->user->name;
       })   
       ->editColumn('lokasi_bencana',function($d){
        return $d->info_posko->lokasi_bencana;
       }) 
       ->editColumn('nama_bencana',function($d){
        return $d->info_posko->jenis_bencana->nama_bencana;
       }) 
       ->editColumn('donasi_uang',function($d){
        $donasi=Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$d->id_aktivitas_donasi)->where('jenis_donasi','uang')->sum('keterangan_donasi');
        return 'Rp. '.number_format($donasi, 0,',','.');
       }) 
       ->editColumn('donasi_barang',function($d){
        $donasi=Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$d->id_aktivitas_donasi)->where('jenis_donasi','pokok')->count();
        return $donasi;
       }) 
       ->editColumn('total_donasi',function($d){
        $donasi=Donasi::where('status_verifikasi', true)->where('id_aktivitas_donasi',$d->id_aktivitas_donasi)->count();
        return $donasi.' Donasi';
       }) 

       ->rawColumns(['tanggal_kejadian','name','lokasi_bencana','nama_bencana','donasi_uang','donasi_barang','total_donasi'])
       ->toJson();
    }

    public function export()
    {
        $items = AktivitasDonasi::with(['info_posko.jenis_bencana','info_posko.user','donasi'])->withTrashed()->get();
        $pdf = PDF::loadView('exports.admin.aktivitas-donasi',['items'=>$items]);
        return $pdf->download('aktivitas-donasi.pdf');

    }

 

    public function exportBencana(Request $request)
    {
        $jenis_bencana = JenisBencana::withTrashed()->findOrFail($request->id_jenis_bencana);
        $info = InfoPosko::where('id_jenis_bencana',$request->id_jenis_bencana)->get();

            $pdf = PDF::loadView('exports.admin.aktivitas-donasi-bencana',[
                'info'=>$info,
                'jenis_bencana'=>$jenis_bencana
                
                ]);
            return $pdf->download('Aktivitas_Donasi.pdf');
        
  
    }
}
