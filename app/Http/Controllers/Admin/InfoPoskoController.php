<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\InfoPosko;
use App\PoskoModel\SubPosko;
use Carbon\Carbon;

class InfoPoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = InfoPosko::with('subposko','jenis_bencana','user')->get();
        return view('pages.admin.datainfoposko.index',[
            'items'=>$items
        ]);
    }

    public function detailsubposko($id)
    {
        $items = SubPosko::where('id_info_posko',$id)->get();
        return view('pages.admin.datainfoposko.detail',[
            'items'=>$items
        ]);
    }

}
