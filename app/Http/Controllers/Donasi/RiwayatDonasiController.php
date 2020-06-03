<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Donasi;
use Auth;

class RiwayatDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $items = Donasi::where('user_id', Auth::user()->user_id)->get();
        return view('pages.donasi.riwayat-donasi',[
            'items'=>$items
        ]);
    }

  
}
