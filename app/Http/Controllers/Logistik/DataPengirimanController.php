<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;
use App\LogistikModel\StokBarang;
use App\LogistikModel\PengirimanBarang;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\LogistikModel\DetailPengirimanBarang;
use Carbon\Carbon;

class DataPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PengirimanBarang::all();
        return view('pages.logistik.datapengiriman.index', [
            'items' => $items
        ]);
    }

    public function detailpengiriman(Request $request, $id_pengiriman)
    {
        $pengiriman = PengirimanBarang::with(['permintaanbarang.infoposko.user'])->findOrFail($id_pengiriman);
        $items = DetailPengirimanBarang::with('stokbarang', 'pengirimanbarang')->where('id_pengiriman_barang', $id_pengiriman)->get();
        return view('pages.logistik.datapengiriman.detail', [
            'items' => $items,
            'pengiriman' => $pengiriman
        ]);
    }


    public function create(Request $request, $id)
    {
        $permintaan = PermintaanBarang::with(['infoposko.user'])->findOrFail($id);
        $items = StokBarang::where('quantity', '>', 0)->get();
        $detail = DetailPermintaanBarang::where('id_permintaan_barang', $id)->get();

        return view('pages.logistik.datapermintaan.create', [
            'permintaan' => $permintaan,
            'stokbarang' => $items,
            'detail' => $detail,
        ]);
    }

    public function store(Request $request, $id_permintaan_barang)
    {
        $request->validate([
            'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
            'jumlah' => ['required', 'min:1'],
            'keterangan_pengiriman' => ['required', 'string', 'max:255'],
            'tanggal_pengiriman' => ['required']
        ], [
            'keterangan_permintaan.required' => 'Keterangan tidak boleh kosong',
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required' => 'Tidak boleh kosong',

        ]);
        if (count($request->id_stok_barang) > 0) {
            $config = [
                'table' => 'pengiriman_barang', 'field' => 'id_pengiriman_barang', 'length' => 20, 'prefix' => 'DLV-' . date('ym'),
                'reset_on_prefix_change' => true
            ];
            $id_pengiriman = IdGenerator::generate($config);
            foreach ($request->id_stok_barang as $item => $v) {
                $detail[] = array(
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
            }

            for ($i = 0; $i < count($detail); $i++) {
                $max = StokBarang::where('id_stok_barang', $detail[$i]['id_stok_barang'])->first();

                if ($detail[$i]['jumlah'] > $max->quantity) {
                    return back()->with(['error' => 'Jumlah yang diinput melebihi jumlah stok']);
                }
            }

            $pengiriman_barang = PengirimanBarang::create([
                'id_pengiriman_barang' => $id_pengiriman,
                'id_permintaan_barang' => $id_permintaan_barang,
                'keterangan_pengiriman' => $request->keterangan_pengiriman,
                'tanggal_pengiriman' => $request->tanggal_pengiriman
            ]);

            $pengiriman_barang->detailPengirimanBarang()->createMany($detail);

            $pengiriman_barang->permintaanBarang->update(
                ['status_pengiriman' => true]
            );
        }

        foreach ($request->id_stok_barang as $item => $v) {
            $stokbarang = StokBarang::where('id_stok_barang', $request->id_stok_barang[$item])->get();
            foreach ($stokbarang as $stok) {
                $stok->quantity -= $request->jumlah[$item];
                $stok->save();
            }
        }
        return redirect('/logistik/data-pengiriman')->with(['sukses' => 'Data Pengiriman Berhasil Di Buat']);
    }

    public function destroy($id)
    {
        $pengiriman_barang = PengirimanBarang::findOrFail($id);

        foreach ($pengiriman_barang->detailPengirimanBarang as $detail) {
            $stokBarang = StokBarang::findOrFail($detail->id_stok_barang);
            $stokBarang->quantity += $detail->jumlah;
            $stokBarang->save();

            $detail->delete();
        }
        $pengiriman_barang->permintaanBarang->update([
            'status_pengiriman' => false
        ]);

        $pengiriman_barang->delete();

        return redirect()->back()->with('sukses', 'Data berhasil di hapus');
    }
}
