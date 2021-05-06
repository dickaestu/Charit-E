<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapPermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PermintaanBarang::where('status_permintaan', 'VERIFIED')->get();
        return view('pages.logistik.laporanpermintaan', compact('items'));
    }

    public function getpermintaan()
    {
        return \DataTables::eloquent(PermintaanBarang::with(['infoposko'])->select('permintaan_barang.*'))
            ->editColumn('tanggal_permintaan', function ($d) {
                return Carbon::create($d->tanggal_permintaan)->format('d-m-Y');
            })
            ->editColumn('status_penerimaan', function ($d) {
                return $d->status_penerimaan ? ' Diterima' : 'Belum Diterima';
            })
            ->addColumn('detail_permintaan', function ($d) {
                return '<a href="/logistik/export-detail-permintaan/' . $d->id_permintaan_barang . '" class="btn btn-sm btn-info">Print Detail</a>';
            })
            ->rawColumns(['tanggal_permintaan', 'status_pengiriman', 'status_penerimaan', 'detail_permintaan'])
            ->toJson();
    }

    public function export()
    {
        $items = PermintaanBarang::with('infoposko')->where('status_permintaan', 'VERIFIED')->get();
        $pdf = PDF::loadView('exports.logistik.permintaan-logistik', ['items' => $items]);
        // return $pdf->download('permintaan-logistik.pdf');
        return $pdf->stream();
    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $items = PermintaanBarang::with('infoposko')->whereBetween('tanggal_permintaan', [$startDate, $endDate])->where('status_permintaan', 'VERIFIED')->get();
        $pdf = PDF::loadView('exports.logistik.permintaan-logistik-bulanan', [
            'items' => $items,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
        // return $pdf->download('permintaan-logistik.pdf');
        return $pdf->stream();
    }

    public function exportDetail($id)
    {
        $items = DetailPermintaanBarang::where('id_permintaan_barang', $id)->get();
        $permintaan = PermintaanBarang::findOrFail($id);
        $pdf = PDF::loadView('exports.logistik.detail.detail-permintaan-logistik', ['items' => $items, 'permintaan' => $permintaan]);
        // return $pdf->download('detail-permintaan-logistik.pdf');
        return $pdf->stream();
    }
}
