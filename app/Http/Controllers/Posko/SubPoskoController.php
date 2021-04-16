<?php

namespace App\Http\Controllers\Posko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\SubPosko;
use App\PoskoModel\InfoPosko;
use Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SubPoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items = SubPosko::with('info_posko')->where('id_info_posko', $id)->get();
        return view('pages.posko.subposko.index', [
            'items' => $items,
            'id_info_posko' => $id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('pages.posko.subposko.create', [
            'id_info_posko' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_info_posko)
    {
        $request->validate([
            'nama_sub_posko' => ['required', 'max:100', 'string'],
            'nama_penanggung_jawab' => ['required', 'string', 'max:100'],
        ], [
            'nama_sub_posko.required' => 'Nama sub posko tidak boleh kosong',
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab tidak boleh kosong'
        ]);

        $config = [
            'table' => 'sub_posko', 'field' => 'id_sub_posko', 'length' => 20, 'prefix' => 'SUB-' . date('ym'),
            'reset_on_prefix_change' => true
        ];
        $id = IdGenerator::generate($config);
        $data = $request->all();
        $data['id_sub_posko'] = $id;
        $data['id_info_posko'] = $id_info_posko;

        SubPosko::create($data);

        return redirect()->route('sub-posko.index', $id_info_posko)->with('sukses', 'Data Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = SubPosko::findOrFail($id);
        return view('pages.posko.subposko.edit', [
            'item' => $item,
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
            'nama_sub_posko' => ['required', 'max:255', 'string'],
            'nama_penanggung_jawab' => ['required', 'string', 'max:255'],
        ], [
            'nama_sub_posko.required' => 'Nama sub posko tidak boleh kosong',
            'nama_penanggung_jawab.required' => 'Nama penanggung jawab tidak boleh kosong'
        ]);

        $data = $request->all();
        $item = SubPosko::findOrFail($id);

        $item->update($data);
        return redirect()->route('sub-posko.index', $item->id_info_posko)->with('sukses', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SubPosko::findOrFail($id);
        $item->delete();
        return redirect()->route('sub-posko.index', $item->id_info_posko)->with('sukses', 'Data Berhasil Dihapus');
    }
}
