<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\BarangMasuk;
use App\LogistikModel\DetailBarangMasuk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class LapBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = BarangMasuk::all();
        return view('pages.logistik.laporanbarangmasuk', compact('items'));
    }

    public function getbarangmasuk()
    {
        return \DataTables::eloquent(BarangMasuk::with(['donasi'])->select('barang_masuk.*'))
            ->editColumn('tanggal_masuk', function ($d) {
                return Carbon::create($d->tanggal_barang_masuk)->format('d-m-Y');
            })
            ->editColumn('name', function ($d) {
                return $d->donasi->nama_donatur;
            })
            ->editColumn('nama_barang', function ($d) {
                return $d->stokbarang->nama_barang;
            })
            ->editColumn('satuan_barang', function ($d) {
                return $d->stokbarang->satuan;
            })
            ->rawColumns(['tanggal_masuk', 'name', 'nama_barang', 'satuan_barang'])
            ->toJson();
    }

    public function export()
    {
        $items = BarangMasuk::all();
        $pdf = PDF::loadView('exports.logistik.barangmasuk', ['items' => $items]);
        // return $pdf->download('barangmasuk.pdf');
        return $pdf->stream();
    }

    public function exportBulan(Request $request)
    {
        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $items = BarangMasuk::whereBetween('tanggal_barang_masuk', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('exports.logistik.barangmasuk-bulan', [
            'items' => $items,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
        // return $pdf->download('barangmasuk.pdf');
        return $pdf->stream();
    }

    public function exportDetail($id)
    {
        $items = DetailBarangMasuk::where('id_barang_masuk', $id)->get();
        $barangMasuk = BarangMasuk::findOrFail($id);
        $pdf = PDF::loadView(
            'exports.logistik.detail.detail-barang-masuk',
            ['items' => $items, 'barangMasuk' => $barangMasuk]
        );
        // return $pdf->download('detail-pengiriman-logistik.pdf');
        return $pdf->stream();
    }
}
