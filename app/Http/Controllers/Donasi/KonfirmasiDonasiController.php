<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Donasi;
use Auth;
use Carbon\Carbon;
use App\AdminModel\AktivitasDonasi;

class KonfirmasiDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $aktivitas = AktivitasDonasi::findOrFail($id);
        $config = [
            'table' => 'donasi', 'field' => 'id_donasi', 'length' => 20, 'prefix' => 'DNS-' . date('ym'),
            'reset_on_prefix_change' => true
        ];
        $id_donasi = IdGenerator::generate($config);
        $id = $id_donasi;

        return view('pages.donasi.konfirmasi-donasi', [
            'id' => $id,
            'aktivitas' => $aktivitas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $request->validate([
            'keterangan_donasi' => ['required'],
            'foto_bukti' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2000'],
            'is_anonim' => ['boolean']
        ], [
            'foto_bukti.image' => 'Yang anda masukkan bukan gambar',
            'foto_bukti.mimes' => 'Format harus jpg/png/jpeg',
            'keterangan_donasi.required' => 'Keterangan/nominal harus diisi',
        ]);

        Donasi::create([
            'id_donasi' => $request->id_donasi,
            'id_aktivitas_donasi' => $id,
            'user_id' => Auth::user()->user_id,
            'is_anonim' => $request->is_anonim ? $request->is_anonim : 0,
            'status_verifikasi' => false,
            'keterangan_donasi' => $request->keterangan_donasi,
            'foto_bukti' => $request->file('foto_bukti')->store(
                'assets/gallery',
                'public'
            ),
            'tanggal_donasi' => Carbon::now()
        ]);

        return  redirect()->route('sukses', $id);
    }

    public function sukses()
    {
        return view('pages.donasi.sukses');
    }
}
