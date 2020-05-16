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

    
}
