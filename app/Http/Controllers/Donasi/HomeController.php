<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\AktivitasDonasi;
use App\Donasi;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AktivitasDonasi::with(['info_posko.jenis_bencana', 'info_posko.user'])->where('is_active', true)->get();

        return view('pages.donasi.home', [
            'items' => $items,
        ]);
    }

    public function bantuan()
    {

        return view('pages.donasi.bantuan');
    }
}
