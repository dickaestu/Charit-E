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
        $jenis_bencana = JenisBencana::all();
        $aktivitas_donasi = AktivitasDonasi::all();

        foreach ($aktivitas_donasi as $aktivitas) {
            $data[] = (object) [
                'id_aktivitas_donasi' => $aktivitas->id_aktivitas_donasi,
                'total_donasi' => Donasi::where('id_aktivitas_donasi', $aktivitas->id_aktivitas_donasi)->where('status_verifikasi', true)->count(),
                'tanggal_kejadian' => Carbon::create($aktivitas->info_posko->tanggal_kejadian)->format('d-m-Y'),
                'id_info_posko' => $aktivitas->id_info_posko,
                'nama_posko' => $aktivitas->info_posko->user->name,
                'nama_bencana' =>  $aktivitas->info_posko->jenis_bencana->nama_bencana,
                'lokasi_bencana' => $aktivitas->info_posko->lokasi_bencana
            ];
        }

        return view('pages.admin.laporanaktivitasdonasi', [
            'jenis_bencana' => $jenis_bencana,
            'items' => $data
        ]);
    }



    public function export()
    {
        $aktivitas_donasi = AktivitasDonasi::with(['info_posko.jenis_bencana', 'info_posko.user', 'donasi'])->get();
        foreach ($aktivitas_donasi as $aktivitas) {
            $data[] = (object) [
                'id_aktivitas_donasi' => $aktivitas->id_aktivitas_donasi,
                'total_donasi' => Donasi::where('id_aktivitas_donasi', $aktivitas->id_aktivitas_donasi)->where('status_verifikasi', true)->count(),
                'tanggal_kejadian' => Carbon::create($aktivitas->info_posko->tanggal_kejadian)->format('d-m-Y'),
                'id_info_posko' => $aktivitas->id_info_posko,
                'nama_posko' => $aktivitas->info_posko->user->name,
                'nama_bencana' =>  $aktivitas->info_posko->jenis_bencana->nama_bencana,
                'lokasi_bencana' => $aktivitas->info_posko->lokasi_bencana
            ];
        }
        $pdf = PDF::loadView('exports.admin.aktivitas-donasi', ['items' => $data])->setPaper('a4', 'landscape');
        // return $pdf->download('aktivitas-donasi.pdf');
        return $pdf->stream();
    }



    public function exportBencana(Request $request)
    {
        $jenis_bencana = JenisBencana::withTrashed()->findOrFail($request->id_jenis_bencana);
        $info = InfoPosko::where('id_jenis_bencana', $request->id_jenis_bencana)->get();

        $pdf = PDF::loadView('exports.admin.aktivitas-donasi-bencana', [
            'info' => $info,
            'jenis_bencana' => $jenis_bencana

        ]);
        return $pdf->download('Aktivitas_Donasi.pdf');
    }
}
