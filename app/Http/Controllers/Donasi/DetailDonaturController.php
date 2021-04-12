<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\AktivitasDonasi;
use App\Donasi;

class DetailDonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $item = AktivitasDonasi::findOrFail($id);
        $donasiNotVerif = Donasi::with('aktivitasdonasi')->where('status_verifikasi', false)
            ->where('id_aktivitas_donasi', $id)->orderBy('tanggal_donasi', 'desc')->get();

        return view('pages.donasi.detaildonatur', [
            'item' => $item,
            'donasiNotVerif' => $donasiNotVerif,
        ]);
    }
}
