<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Donasi;
use Auth;
use App\User;
use App\LogistikModel\StokBarang;
use App\LogistikModel\BarangMasuk;
use App\LogistikModel\UangMasuk;
use App\AdminModel\JenisBencana;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use App\PoskoModel\InfoPosko;
use App\AdminModel\AktivitasDonasi;

class DonasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $item = Donasi::with(['user'])->get();
        return view('pages.logistik.donasimasuk.index', [
            'items' => $item
        ]);
    }

    public function verifikasibarang(Request $request, $id)
    {
        $donasi = $id;
        $stokbarang = StokBarang::all();
        return view('pages.logistik.donasimasuk.verifikasi', [
            'stokbarang' => $stokbarang,
            'donasi' => $donasi
        ]);
    }



    public function sukses(Request $request, $id)
    {
        $id_user = Donasi::findOrFail($id);

        if (count($request->id_stok_barang) > 0) {
            $config = [
                'table' => 'barang_masuk', 'field' => 'id_barang_masuk', 'length' => 14, 'prefix' => 'BRGMSK-' . date('ym'),
                'reset_on_prefix_change' => true
            ];
            foreach ($request->id_stok_barang as $item => $v) {

                $idBarangMasuk = IdGenerator::generate($config);
                $request->validate([
                    'id_stok_barang' => ['required', 'exists:stok_barang,id_stok_barang'],
                    'jumlah' => ['required'],
                ], [
                    'id_stok_barang.required' => 'Anda belum memilih barang',
                    'id_stok_barang.exists' => 'Anda belum memilih barang',
                    'jumlah.required' => 'Tidak boleh kosong',
                ]);

                $detail[] = [
                    'id_barang_masuk' => $idBarangMasuk . mt_rand(100, 999) . ($id_user->user_id + mt_rand(10, 99)),
                    'id_donasi' => $id,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'tanggal_barang_masuk' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            BarangMasuk::insert($detail);
        }
        foreach ($request->id_stok_barang as $item => $v) {
            $stokbarang = StokBarang::where('id_stok_barang', $request->id_stok_barang[$item])->get();
            foreach ($stokbarang as $stok) {
                $stok->quantity += $request->jumlah[$item];
                $stok->save();
            }
        }

        $donasi = Donasi::findOrFail($id);

        $donasi->status_verifikasi = true;
        $donasi->save();

        return redirect()->route('donasi-masuk-logistik')->with('sukses', 'Verifikasi Berhasil');
    }





    public function getdatadonasi()
    {
        return \DataTables::eloquent(Donasi::with(['aktivitasdonasi.info_posko.jenis_bencana'])->select('donasi.*')->where('status_verifikasi', true))
            ->editColumn('tanggal_donasi', function ($d) {
                return Carbon::create($d->tanggal_donasi)->format('d-m-Y');
            })
            ->editColumn('status_verifikasi', function ($d) {
                return $d->status_verifikasi ? 'Verified' : 'Pending';
            })
            ->editColumn('lokasi_bencana', function ($d) {
                return $d->aktivitasdonasi->info_posko->lokasi_bencana;
            })
            ->editColumn('nama_bencana', function ($d) {
                return $d->aktivitasdonasi->info_posko->jenis_bencana->nama_bencana;
            })
            ->rawColumns(['tanggal_donasi', 'status_verifikasi', 'lokasi_bencana', 'nama_bencana'])
            ->toJson();
    }

    public function export()
    {
        $donasi = Donasi::with(['aktivitasdonasi.info_posko.jenis_bencana'])->where('status_verifikasi', true)->get();
        $pdf = PDF::loadView('exports.logistik.donasimasuk', ['items' => $donasi]);
        return $pdf->download('donasimasuk.pdf');
    }

    public function exportBulan(Request $request)
    {

        $startDate =  Carbon::create($request->from)->format('Y-m-d');
        $endDate   = Carbon::create($request->to)->format('Y-m-d');
        $donasi = Donasi::with(['aktivitasdonasi.info_posko.jenis_bencana'])->where('status_verifikasi', true)->whereBetween('tanggal_donasi', [$startDate, $endDate])->get();
        $pdf = PDF::loadView('exports.logistik.donasimasuk-bulan', [
            'items' => $donasi,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
        return $pdf->download('donasimasuk.pdf');
    }

    public function exportBencana(Request $request)
    {
        $jenis_bencana = JenisBencana::withTrashed()->findOrFail($request->id_jenis_bencana);
        $info = InfoPosko::with(['jenis_bencana'])->where('id_jenis_bencana', $request->id_jenis_bencana)->get();

        $pdf = PDF::loadView('exports.logistik.donasimasuk-bencana', [
            'info' => $info,
            'jenis_bencana' => $jenis_bencana

        ]);
        return $pdf->download('donasimasuk.pdf');
    }
}
