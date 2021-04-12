<?php

namespace App\Http\Controllers\Logistik;

use Illuminate\Support\Facades\DB, Exception;
use App\Http\Controllers\Controller;
use App\LogistikModel\StokBarang;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StokBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = StokBarang::all();
        return view('pages.logistik.datastokbarang.index', ['items' => $items]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:100'],
            'satuan' => ['required', 'string', 'in:dus,sak,buah,unit,pcs,lembar'],
            'deskripsi_barang' => ['required', 'max:255'],
        ], [
            'nama_barang.required' => 'Nama barang tidak boleh kosong',
            'satuan.in' => 'Satuan harus dipilih',
        ]);

        $config = [
            'table' => 'stok_barang', 'field' => 'id_stok_barang', 'length' => 20, 'prefix' => 'STOK-' . date('ym'),
            'reset_on_prefix_change' => true
        ];
        $id = IdGenerator::generate($config);


        $data = new StokBarang;
        $data->id_stok_barang = $id;
        $data->nama_barang = $request->nama_barang;
        $data->satuan = $request->satuan;
        $data->deskripsi_barang = $request->deskripsi_barang;
        $data->save();

        return redirect('logistik/data-stok-barang')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = StokBarang::findOrFail($id);

        return view('pages.logistik.datastokbarang.edit', [
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
            'nama_barang' => ['required', 'string', 'max:100'],
            'satuan' => ['required', 'string', 'in:dus,sak,buah,unit,pcs,lembar'],
            'deskripsi_barang' => ['required', 'max:255'],
        ]);

        $data = $request->all();
        $item = StokBarang::findOrFail($id);

        $item->update($data);
        return redirect('logistik/data-stok-barang')->with('edit', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = StokBarang::findOrFail($id);
        $item->delete();
        return redirect()->route('data-stok-barang.index')->with('dihapus', 'Data Berhasil Dihapus');
    }
}
