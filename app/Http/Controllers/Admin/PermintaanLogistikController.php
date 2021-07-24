<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\PermintaanBarangVerified;
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
        return view('pages.admin.datapermintaan.index', [
            'items' => $items
        ]);
    }

    public function detailpermintaan($id)
    {
        $info = PermintaanBarang::findOrFail($id);
        $items = DetailPermintaanBarang::with(['stokbarang'])->where('id_permintaan_barang', $id)->get();
        return view('pages.admin.datapermintaan.detailpermintaan', [
            'items' => $items,
            'info' => $info
        ]);
    }

    public function verifikasi($id)
    {
        $data['status_permintaan'] = 'VERIFIED';
        $item = PermintaanBarang::findOrFail($id);
        $item->update($data);
        $item->notify(new PermintaanBarangVerified($item));
        return redirect('admin/data-permintaan')->with('sukses', 'Data Berhasil Di Verifikasi');
    }

    public function tolak(Request $request, $id)
    {
        $data['status_permintaan'] = 'BATAL';
        $data['keterangan_ditolak'] = $request->keterangan_ditolak;
        $item = PermintaanBarang::findOrFail($id);
        $item->update($data);
        return redirect('admin/data-permintaan')->with('sukses', 'Permintaan Di Berhasil Tolak');
    }

    public function permintaanUnverif()
    {
        $data = PermintaanBarang::where('status_permintaan', 'PENDING')->get();

        return response()->json($data);
    }
}
