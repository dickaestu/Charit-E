<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\InfoPosko;
use App\PoskoModel\SubPosko;
use Carbon\Carbon;
use App\AdminModel\JenisBencana;
use Illuminate\Support\Facades\DB;
use PDF;

class InfoPoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = JenisBencana::withTrashed()->get();
        $infoPosko = InfoPosko::with('subposko', 'jenis_bencana', 'user')->get();
        return view('pages.admin.datainfoposko.index', [
            'jenis_bencana' => $items,
            'infoPosko' => $infoPosko
        ]);
    }

    public function detailsubposko($id)
    {
        $item_id = $id;
        $items = SubPosko::where('id_info_posko', $id)->get();
        return view('pages.admin.datainfoposko.detail', [
            'items' => $items,
            'id' => $item_id
        ]);
    }



    public function export()
    {
        $items = InfoPosko::with('subposko', 'jenis_bencana', 'user')->orderBy('tanggal_kejadian', 'asc')->get();
        $pdf = PDF::loadView('exports.admin.data-info-posko', ['items' => $items]);
        return $pdf->download('info-posko.pdf');
    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $items = InfoPosko::with('subposko', 'jenis_bencana', 'user')->whereBetween('tanggal_kejadian', [$startDate, $endDate])->orderBy('tanggal_kejadian', 'asc')->get();
        $pdf = PDF::loadView('exports.admin.data-info-posko-bulan', [
            'items' => $items,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
        return $pdf->download('info-posko.pdf');
    }

    public function exportSubPosko($id)
    {
        $items = SubPosko::where('id_info_posko', $id)->get();
        $item2 = InfoPosko::findOrFail($id);
        $pdf = PDF::loadView('exports.admin.data-sub-posko', ['items' => $items, 'itemm' => $item2]);
        return $pdf->download('sub_posko.pdf');
    }


    public function exportBencana(Request $request)
    {
        $jenis_bencana = JenisBencana::withTrashed()->findOrFail($request->id_jenis_bencana);
        $items = InfoPosko::with('subposko', 'jenis_bencana', 'user')->where('id_jenis_bencana', $request->id_jenis_bencana)->orderBy('tanggal_kejadian', 'asc')->get();
        $pdf = PDF::loadView('exports.admin.info-posko-bencana', ['items' => $items, 'jenis_bencana' => $jenis_bencana]);
        return $pdf->download('info-posko.pdf');
    }
}
