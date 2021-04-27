<?php

namespace App\Http\Controllers\Posko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\StokBarang;
use App\PoskoModel\InfoPosko;
use Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\PoskoModel\PermintaanBarang;
use App\LogistikModel\PengirimanBarang;
use App\Notifications\PermintaanBarang as NotificationsPermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;
use App\PoskoModel\PenerimaanBarang;

class DataPermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PermintaanBarang::with(['infoposko.jenis_bencana', 'pengirimanbarang'])
            ->whereHas('infoposko', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->get();
        return view('pages.posko.datapermintaan.index', [
            'items' => $items,
        ]);
    }

    public function create(Request $request, $id)
    {
        $stokbarang = StokBarang::where('quantity', '>', 0)->get();

        return view('pages.posko.datapermintaan.create', [
            'id_info_posko' => $id,
            'stokbarang' => $stokbarang,
        ]);
    }



    public function store(Request $request, $id_info_posko)
    {
        $request->validate([
            'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
            'jumlah' => ['required', 'min:1'],
            'keterangan_permintaan' => ['required', 'string', 'max:255'],
        ], [
            'keterangan_permintaan.required' => 'Keterangan tidak boleh kosong',
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required' => 'Tidak boleh kosong'
        ]);

        $config = [
            'table' => 'permintaan_barang', 'field' => 'id_permintaan_barang', 'length' => 20, 'prefix' => 'REQ-' . date('ym'),
            'reset_on_prefix_change' => true
        ];
        $id_permintaan = IdGenerator::generate($config);

        if (count($request->id_stok_barang) > 0) {

            foreach ($request->id_stok_barang as $item => $v) {
                $detail[] = array(
                    'id_permintaan_barang' => $id_permintaan,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
            }
            // DetailPermintaanBarang::insert($detail);

            $permintaanBarang = PermintaanBarang::create([
                'id_permintaan_barang' => $id_permintaan,
                'id_info_posko' => $id_info_posko,
                'keterangan_permintaan' => $request->keterangan_permintaan,
                'status_permintaan' => 'PENDING',
                'status_penerimaan' => false,
                'status_pengiriman' => false,
                'tanggal_permintaan' => Carbon::now(),
            ]);

            $permintaanBarang->detailpermintaanBarang()->createMany($detail);
            $permintaanBarang->notify(new NotificationsPermintaanBarang($permintaanBarang));
        }
        return redirect()->route('info-posko.index')->with('sukses', 'Permintaan Berhasil Dibuat, Data Akan Segera Di Proses');
    }

    public function detailpermintaan(Request $request, $id)
    {
        $items = DetailPermintaanBarang::with(['stokbarang'])->where('id_permintaan_barang', $id)->get();
        return view('pages.posko.datapermintaan.detailpermintaan', [
            'items' => $items
        ]);
    }

    public function hapus($id)
    {
        $item = PermintaanBarang::findOrFail($id);

        $item->detailPermintaanBarang()->delete();
        $item->delete();

        return redirect('/posko')->with('sukses', 'Data Berhasil Di Hapus');
    }
}
