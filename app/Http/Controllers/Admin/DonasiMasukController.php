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
        $items = Donasi::with(['aktivitasdonasi', 'aktivitasdonasi.info_posko.jenis_bencana'])->where('status_verifikasi', true)->get();
        return view('pages.admin.laporandonasimasuk', [
            'items' => $items
        ]);
    }



    public function export()
    {
        $donasi = Donasi::where('status_verifikasi', true)->get();
        $pdf = PDF::loadView('exports.admin.donasi-masuk', ['items' => $donasi])->setPaper('a4', 'landscape');
        // return $pdf->download('donasimasuk.pdf');
        return $pdf->stream();
    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from);
        $endDate   = Carbon::create($request->to)->addDays(1);
        $donasi = Donasi::where('status_verifikasi', true)->whereBetween('created_at', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('exports.admin.donasimasuk', ['items' => $donasi]);
        return $pdf->download('donasimasuk.pdf');
    }
}
