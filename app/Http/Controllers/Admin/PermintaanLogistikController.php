<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;

class PermintaanLogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PermintaanBarang::with(['infoposko'])->get();
        return view('pages.admin.datapermintaan.permintaanlogistik',[
            'items'=>$items
        ]);
    }

    public function detailpermintaan($id)
    {
        $info = PermintaanBarang::findOrFail($id);
        $items = DetailPermintaanBarang::with(['stokbarang'])->where('id_permintaan_barang', $id)->get();
        return view('pages.admin.datapermintaan.detailpermintaan',[
            'items'=>$items,
            'info'=>$info
        ]);
    }

    public function verifikasi($id)
    {
        $data['status_permintaan'] = 'VERIFIED';
        $item = PermintaanBarang::findOrFail($id);
        $item->update($data);
        return redirect('admin/data-permintaan')->with('verified','Data Berhasil Di Verifikasi');
    }

    public function tolak($id)
    {
        $data['status_permintaan'] = 'BATAL';
        $item = PermintaanBarang::findOrFail($id);
        $item->update($data);
        return redirect('admin/data-permintaan')->with('batal','Permintaan Di Berhasil Tolak');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
