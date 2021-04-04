<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\AktivitasDonasi;
use App\User;
use App\PoskoModel\InfoPosko;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DataAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = AktivitasDonasi::with(['info_posko.user', 'info_posko.jenis_bencana'])->get(); //memanggil relasi yang sudah dibuat di model

        return view('pages.admin.dataaktivitasdonasi.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info_posko = InfoPosko::with(['user', 'jenis_bencana'])->where('is_active', false)->get();
        return view('pages.admin.dataaktivitasdonasi.create', [
            'info_posko' => $info_posko
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_info_posko' => ['required', 'exists:info_posko,id_info_posko', 'unique:aktivitas_donasi,id_info_posko'],
            'foto_aktivitas' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2000'],
            'keterangan_aktivitas' => ['required', 'max:255', 'string'],
        ], [
            'id_info_posko.unique' => 'Aktivitas ini sudah pernah dibuat',
            'foto_aktivitas.image' => 'Yang anda masukkan bukan gambar',
            'foto_aktivitas.mimes' => 'Format harus jpeg/png/jpeg',
            'keterangan_aktivitas.required' => 'Keterangan harus diisi',
        ]);

        $config = [
            'table' => 'aktivitas_donasi', 'field' => 'id_aktivitas_donasi', 'length' => 13, 'prefix' => 'AKTV-',
            'reset_on_prefix_change' => true
        ];
        $id = IdGenerator::generate($config);

        $data = $request->all();
        $data['id_aktivitas_donasi'] = $id;
        $data['foto_aktivitas'] = $request->file('foto_aktivitas')->store(
            'assets/gallery',
            'public'
        );

        $infoPosko = InfoPosko::findOrFail($request->id_info_posko);
        $infoPosko->update([
            'is_active' => true
        ]);

        AktivitasDonasi::create($data);
        return redirect('admin/data-aktivitas')->with('sukses', 'Data Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = AktivitasDonasi::findOrFail($id);
        return view('pages.admin.dataaktivitasdonasi.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_aktivitas' => ['image', 'mimes:jpg,png,jpeg', 'max:2000'],
            'keterangan_aktivitas' => ['required', 'max:255', 'string'],
            'is_active' => ['required', 'boolean']
        ], [
            'foto_aktivitas.image' => 'Yang anda masukkan bukan gambar',
            'foto_aktivitas.mimes' => 'Format harus jpeg/png/jpeg',
            'keterangan_aktivitas.required' => 'Keterangan harus diisi',
            'is_active' => 'Wajib Di Pilih'
        ]);

        $item = AktivitasDonasi::findOrFail($id);


        $data = $request->all();
        if ($request->foto_aktivitas != null) {
            $data['foto_aktivitas'] = $request->file('foto_aktivitas')->store(
                'assets/gallery',
                'public'
            );
        }

        $item->update($data);
        return redirect('admin/data-aktivitas')->with('edit', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AktivitasDonasi::findOrFail($id);
        $item->delete();
        return redirect()->route('data-aktivitas.index')->with('dihapus', 'Data Berhasil Dihapus');
    }
}
