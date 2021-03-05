<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use App\User;
use App\PoskoModel\InfoPosko;
use App\PoskoModel\PermintaanBarang;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date_donasi = Carbon::now()->format('Y-m-d');
        $month_bencana = Carbon::now()->format('m');
        $year_bencana = Carbon::now()->format('Y');

        $donasi = Donasi::where('tanggal_donasi', $date_donasi)->where('status_verifikasi', true)->count();
        $bencana = InfoPosko::whereMonth('tanggal_kejadian', $month_bencana)->whereYear('tanggal_kejadian', $year_bencana)->count();
        $request_logistik = PermintaanBarang::where('status_permintaan', 'PENDING')->count();
        $user = User::where('role', 'DONATUR')->count();
        $data = [];
        for ($i = 1; $i < 13; $i++) {
            $data[] = InfoPosko::whereMonth('tanggal_kejadian', $i)->whereYear('tanggal_kejadian', $year_bencana)->count();
        }

        $pokok = Donasi::count();

        return view('pages.admin.dashboard', [
            'donasi' => $donasi,
            'user' => $user,
            'bencana' => $bencana,
            'request_logistik' => $request_logistik,
            'data' => $data,
            'pokok' => $pokok,
        ]);
    }
}
