<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\BarangMasuk;
use App\LogistikModel\DetailBarangMasuk;
use App\LogistikModel\StokBarang;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Auth;

class DataBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = BarangMasuk::with(['user'])->get();

        return view('pages.logistik.databarangmasuk.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        $stokbarang = StokBarang::all();
        return view('pages.logistik.databarangmasuk.create', [
            'stokbarang' => $stokbarang,
        ]);
    }

    public function store(Request $request)
    {
        if (count($request->id_stok_barang) > 0) {
            $generate_id_barang_masuk = [
                'table' => 'barang_masuk', 'field' => 'id_barang_masuk', 'length' => 20, 'prefix' => 'BRGMSK-' . date('ym'),
                'reset_on_prefix_change' => true
            ];
            $idBarangMasuk = IdGenerator::generate($generate_id_barang_masuk);


            foreach ($request->id_stok_barang as $item => $v) {
                $request->validate([
                    'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
                    'jumlah' => ['required'],
                ], [
                    'id_stok_barang.required' => 'Anda belum memilih barang',
                    'id_stok_barang.exists' => 'Anda belum memilih barang',
                    'jumlah.required' => 'Tidak boleh kosong',
                ]);

                $detail[] = [
                    'id_barang_masuk' => $idBarangMasuk,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            $barangMasuk = BarangMasuk::create([
                'id_barang_masuk' => $idBarangMasuk,
                'tanggal_barang_masuk' => $request->tanggal_barang_masuk,
                'user_id' => Auth::id()
            ]);

            $barangMasuk->detailBarangMasuk()->createMany($detail);
        }
        foreach ($request->id_stok_barang as $item => $v) {
            $stokbarang = StokBarang::where('id_stok_barang', $request->id_stok_barang[$item])->get();
            foreach ($stokbarang as $stok) {
                $stok->quantity += $request->jumlah[$item];
                $stok->save();
            }
        }


        return redirect()->route('data-barang-masuk-logistik')->with('sukses', 'Data Berhasil Dibuat');
    }

    public function detailBarangMasuk($id)
    {
        $items = DetailBarangMasuk::where('id_barang_masuk', $id)->get();
        return view('pages.logistik.databarangmasuk.detail', compact('items'));
    }

    public function detailBarangMasukEdit($id)
    {
        $item = DetailBarangMasuk::findOrFail($id);
        $stokBarang = StokBarang::all();
        return view('pages.logistik.databarangmasuk.detail-edit', compact('item', 'stokBarang'));
    }

    public function detailBarangMasukUpdate(Request $request, $id)
    {
        $request->validate([
            'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
            'jumlah' => ['required'],
        ], [
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required' => 'Tidak boleh kosong',
        ]);

        $detailBarangMasuk = DetailBarangMasuk::findOrfail($id);
        $stokBarang = StokBarang::findOrFail($detailBarangMasuk->id_stok_barang);

        $data = $request->all();
        // Delete stok sebelumnya
        $stokBarang->quantity -= $detailBarangMasuk->jumlah;
        $stokBarang->save();

        $detailBarangMasuk->update($data);
        $newDetailBarangMasuk = DetailBarangMasuk::findOrFail($id);

        $newDetailBarangMasuk->stokBarang->quantity += $request->jumlah;
        $newDetailBarangMasuk->stokBarang->save();


        return redirect()->route('data-barang-masuk-logistik.detail', $detailBarangMasuk->id_barang_masuk)->with('sukses', 'Data Berhasil Di Update');
    }
}
