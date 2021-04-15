<?php

namespace App\Http\Controllers\Posko;

use App\Donasi;
use App\Http\Controllers\Controller;
use App\LogistikModel\StokBarang;
use App\PoskoModel\DetailDonasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetailDonasiMasukController extends Controller
{
    public function index($id)
    {
        $id_donasi = $id;
        $items = DetailDonasi::where('id_donasi', $id)->get();
        return view('pages.posko.detail-donasi.index', compact('items', 'id_donasi'));
    }

    public function create($id)
    {
        $donasi = $id;
        $stokbarang = StokBarang::all();
        return view('pages.posko.detail-donasi.create', [
            'stokbarang' => $stokbarang,
            'donasi' => $donasi
        ]);
    }

    public function store(Request $request, $id)
    {

        $donasi_masuk = DetailDonasi::where('id_donasi', $id)->select('tanggal_donasi_masuk')->first();
        if (count($request->id_stok_barang) > 0) {

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
                    'id_donasi' => $id,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'tanggal_donasi_masuk' => $donasi_masuk->tanggal_donasi_masuk,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            DetailDonasi::insert($detail);
        }


        return redirect()->route('detail-donasi.posko.index', $id)->with('sukses', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $item = DetailDonasi::findOrFail($id);
        $stokBarang = StokBarang::all();
        return view('pages.posko.detail-donasi.edit', compact('item', 'stokBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
            'jumlah' => ['required'],
        ], [
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required' => 'Tidak boleh kosong',
        ]);

        $detailDonasiMasuk = DetailDonasi::findOrfail($id);

        $data = $request->all();

        $detailDonasiMasuk->update($data);

        return redirect()->route('detail-donasi.posko.index', $detailDonasiMasuk->id_donasi)->with('sukses', 'Data Berhasil Di Update');
    }

    public function destroy($id)
    {
        $detailDonasiMasuk = DetailDonasi::findOrfail($id);

        $detailDonasiMasuk->delete();

        return redirect()->route('detail-donasi.posko.index', $detailDonasiMasuk->id_donasi)->with('sukses', 'Data Berhasil Di Hapus');
    }
}
