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

            $generate_id_detail_barang_masuk = [
                'table' => 'detail_barang_masuk', 'field' => 'id_detail_barang_masuk', 'length' => 20, 'prefix' => 'DBRMSK-' . date('ym'),
                'reset_on_prefix_change' => true
            ];
            foreach ($request->id_stok_barang as $item => $v) {

                $idDetailBarangMasuk = IdGenerator::generate($generate_id_detail_barang_masuk);
                $request->validate([
                    'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
                    'jumlah' => ['required'],
                ], [
                    'id_stok_barang.required' => 'Anda belum memilih barang',
                    'id_stok_barang.exists' => 'Anda belum memilih barang',
                    'jumlah.required' => 'Tidak boleh kosong',
                ]);

                $detail[] = [
                    'id_detail_barang_masuk' => $idDetailBarangMasuk,
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
            DetailBarangMasuk::insert($detail);

            // $barangMasuk->detailBarangMasuk()->createMany($detail);
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
}
