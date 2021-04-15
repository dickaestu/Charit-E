<?php

namespace App\Http\Controllers\Posko;

use App\Donasi;
use App\Http\Controllers\Controller;
use App\LogistikModel\StokBarang;
use Illuminate\Http\Request;
use Auth;

class DonasiMasukController extends Controller
{
    public function index(Request $request)
    {
        $items = Donasi::with(['user', 'aktivitasdonasi'])->whereHas('aktivitasdonasi', function ($item) {
            $item->whereHas('info_posko', function ($q) {
                $q->where('user_id', Auth::id());
            });
        })->get();
        return view('pages.posko.donasimasuk.index', [
            'items' => $items
        ]);
    }

    public function verifikasibarang(Request $request, $id)
    {
        $donasi = $id;
        $stokbarang = StokBarang::all();
        return view('pages.posko.donasimasuk.verifikasi', [
            'stokbarang' => $stokbarang,
            'donasi' => $donasi
        ]);
    }
}
