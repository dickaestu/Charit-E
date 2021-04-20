<?php

namespace App\Http\Controllers\Posko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\LogistikModel\StokBarang;
use App\PoskoModel\PenerimaanBarang;
use App\PoskoModel\DetailPenerimaanBarang;
use App\LogistikModel\PengirimanBarang;

class PenerimaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id_permintaan)
    {
        $pengiriman_barang = PengirimanBarang::where('id_permintaan_barang', $id_permintaan)->first();
        if ($pengiriman_barang == null) {
            return redirect('/posko')->with('error', 'Mohon Maaf, Anda Belum Bisa Membuat Laporan Karena Barang Belum Dikirim');
        } else {

            if ($pengiriman_barang->id_permintaan_barang == $id_permintaan) {
                $stok = StokBarang::all();

                return view('pages.posko.data-penerimaan.create', [
                    'stokbarang' => $stok,
                    'pengiriman_barang' => $pengiriman_barang,
                ]);
            }
        }
    }


    public function store(Request $request, $id_pengiriman_barang)
    {
        $request->validate([
            'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
            'jumlah' => ['required'],
            'keterangan_penerimaan' => ['required', 'string', 'max:250'],
            'tanggal_penerimaan' => ['required']
        ], [
            'keterangan_penerimaan.required' => 'Keterangan tidak boleh kosong',
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required' => 'Tidak boleh kosong'
        ]);

        if (count($request->id_stok_barang) > 0) {

            $config = [
                'table' => 'penerimaan_barang', 'field' => 'id_penerimaan_barang', 'length' => 20, 'prefix' => 'RCV-' . date('ym'),
                'reset_on_prefix_change' => true
            ];
            $id_penerimaan_barang = IdGenerator::generate($config);
            foreach ($request->id_stok_barang as $item => $v) {
                $detail[] = array(
                    // 'id_penerimaan_barang' => $id_penerimaan_barang,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
            }


            $penerimaan_barang = PenerimaanBarang::create([
                'id_penerimaan_barang' => $id_penerimaan_barang,
                'id_pengiriman_barang' => $id_pengiriman_barang,
                'keterangan_penerimaan' => $request->keterangan_penerimaan,
                'tanggal_penerimaan' => $request->tanggal_penerimaan
            ]);

            $penerimaan_barang->detailPenerimaanBarang()->createMany($detail);

            $penerimaan_barang->pengirimanBarang->permintaanBarang->update([
                'status_penerimaan' => true
            ]);
        }
        return redirect('/posko')->with('penerimaan', 'Laporan Penerimaan Telah Di Buat');
    }

    public function edit($id)
    {
        $item = DetailPenerimaanBarang::findOrFail($id);
        $stokBarang = StokBarang::all();
        return view('pages.posko.detail-penerimaan.edit', compact('item', 'stokBarang'));
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

        $detailPenerimaanBarang = DetailPenerimaanBarang::findOrfail($id);

        $data = $request->all();

        $detailPenerimaanBarang->update($data);

        return redirect()->route('detail-penerimaan-posko', $detailPenerimaanBarang->penerimaanBarang->pengirimanBarang->id_permintaan_barang)->with('sukses', 'Data Berhasil Di Update');
    }

    public function destroy($id)
    {
        $item = DetailPenerimaanBarang::findOrFail($id);

        $item->delete();

        return redirect()->back()->with('sukses', 'Data berhasil di hapus');
    }

    public function detailpenerimaan(Request $request, $id_permintaan_barang)
    {
        $pengiriman = PengirimanBarang::where('id_permintaan_barang', $id_permintaan_barang)->firstOrFail();
        $penerimaan = PenerimaanBarang::where('id_pengiriman_barang', $pengiriman->id_pengiriman_barang)->first();

        $items = DetailPenerimaanBarang::with(['stokbarang'])->where('id_penerimaan_barang', $penerimaan->id_penerimaan_barang)->get();
        return view('pages.posko.detail-penerimaan.index', [
            'items' => $items,
            'id_penerimaan_barang' => $penerimaan->id_penerimaan_barang
        ]);
    }

    public function detailpenerimaanCreate($id_penerimaan_barang)
    {
        $penerimaanBarang = PenerimaanBarang::findOrFail($id_penerimaan_barang);
        $stokbarang = StokBarang::all();

        return view('pages.posko.detail-penerimaan.create', compact('penerimaanBarang', 'stokbarang'));
    }

    public function detailpenerimaanStore(Request $request, $id_penerimaan_barang)
    {

        $penerimaanBarang = PenerimaanBarang::findOrFail($id_penerimaan_barang);
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
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            $penerimaanBarang->detailPenerimaanBarang()->createMany($detail);
        }

        return redirect()->route('detail-penerimaan-posko', $penerimaanBarang->pengirimanBarang->id_permintaan_barang)->with('sukses', 'Data berhasil ditambah');
    }
}
