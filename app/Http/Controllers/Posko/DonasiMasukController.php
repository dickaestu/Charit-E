<?php

namespace App\Http\Controllers\Posko;

use App\Donasi;
use App\Http\Controllers\Controller;
use App\LogistikModel\StokBarang;
use App\PoskoModel\DetailDonasi;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DonasiMasukController extends Controller
{
    public function index(Request $request)
    {
        $items = Donasi::with(['user', 'aktivitasdonasi'])->whereHas('aktivitasdonasi', function ($item) {
            $item->whereHas('info_posko', function ($q) {
                $q->where('user_id', Auth::id());
            });
        })->orderBy('status_verifikasi', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
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

    public function sukses(Request $request, $id)
    {
        if (count($request->id_stok_barang) > 0) {

            foreach ($request->id_stok_barang as $item => $v) {

                $request->validate([
                    'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
                    'jumlah' => ['required'],
                    'tanggal_donasi_masuk' => ['required', 'date']
                ], [
                    'id_stok_barang.required' => 'Anda belum memilih barang',
                    'id_stok_barang.exists' => 'Anda belum memilih barang',
                    'jumlah.required' => 'Tidak boleh kosong',
                ]);

                $detail[] = [
                    'id_donasi' => $id,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'tanggal_donasi_masuk' => $request->tanggal_donasi_masuk,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            DetailDonasi::insert($detail);
        }

        $donasi = Donasi::findOrFail($id);

        $donasi->status_verifikasi = true;
        $donasi->save();

        return redirect()->route('donasi-masuk-posko')->with('sukses', 'Verifikasi Berhasil');
    }
}
