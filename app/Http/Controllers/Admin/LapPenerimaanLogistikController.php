<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PenerimaanBarang;
use App\PoskoModel\DetailPenerimaanBarang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapPenerimaanLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PenerimaanBarang::all();
        return view('pages.admin.laporanpenerimaanlogistik', compact('items'));
    }


    public function getpenerimaan()
    {
        return \DataTables::eloquent(PenerimaanBarang::with(['pengirimanbarang'])->select('penerimaan_barang.*'))
            ->editColumn('tanggal_penerimaan', function ($d) {
                return Carbon::create($d->tanggal_penerimaan)->format('d-m-Y');
            })
            ->editColumn('name', function ($d) {
                return $d->pengirimanbarang->permintaanbarang->infoposko->user->name;
            })
            ->editColumn('alamat_posko', function ($d) {
                return $d->pengirimanbarang->permintaanbarang->infoposko->alamat_posko;
            })
            ->editColumn('nama_bencana', function ($d) {
                return $d->pengirimanbarang->permintaanbarang->infoposko->jenis_bencana->nama_bencana;
            })
            ->addColumn('detail_penerimaan', function ($d) {
                return '<a href="/admin/laporan-penerimaan/detail/' . $d->id_penerimaan_barang . '" class="btn btn-sm btn-info">Detail</a>';
            })
            ->rawColumns(['tanggal_penerimaan', 'name', 'alamat_posko', 'nama_bencana', 'detail_penerimaan'])
            ->toJson();
    }


    public function detailpenerimaan($id)
    {
        $info = PenerimaanBarang::with('pengirimanbarang.permintaanbarang.infoposko')->findOrFail($id);
        $items = DetailPenerimaanBarang::with(['stokbarang'])->where('id_penerimaan_barang', $id)->get();
        return view('pages.admin.detailpenerimaan', [
            'items' => $items,
            'info' => $info
        ]);
    }

    public function export()
    {
        $items = PenerimaanBarang::with('pengirimanbarang')->get();
        $pdf = PDF::loadView('exports.admin.penerimaan-logistik', ['items' => $items])->setPaper('a4', 'landscape');
        // return $pdf->download('penerimaan-logistik.pdf');
        return $pdf->stream();
    }

    public function exportBulan(Request $request)
    {
        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $items = PenerimaanBarang::with('pengirimanbarang')->whereBetween('tanggal_penerimaan', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('exports.admin.penerimaan-logistik-bulanan', [
            'items' => $items,
            'startDate' => $startDate,
            'endDate' => $endDate
        ])->setPaper('a4', 'landscape');
        // return $pdf->download('penerimaan-logistik.pdf');
        return $pdf->stream();
    }

    public function exportDetail($id)
    {
        $items = DetailPenerimaanBarang::where('id_penerimaan_barang', $id)->get();
        $penerimaan = PenerimaanBarang::findOrFail($id);
        $pdf = PDF::loadView('exports.admin.detail.detail-penerimaan-logistik', ['items' => $items, 'penerimaan' => $penerimaan]);
        // return $pdf->download('detail-penerimaan-logistik.pdf');
        return $pdf->stream();
    }
}
