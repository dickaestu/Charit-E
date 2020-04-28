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
        return view('pages.logistik.datastokbarang.index', ['items'=>$items]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_barang'=>['required','string','max:255'],
            'satuan'=>['required','string','in:dus,sak,buah,unit,pcs'],
        ],[
            'nama_barang.required'=> 'Nama barang tidak boleh kosong',
            'satuan.in'=> 'Satuan harus dipilih',
            ]);

            $config=[
                'table'=>'stok_barang','field'=>'id_stok_barang','length'=> 9,'prefix'=>'STOK-'
            ];
            $id = IdGenerator::generate($config);
            

            $data = new StokBarang;
            $data->id_stok_barang = $id;
            $data->nama_barang = $request->nama_barang;
            $data->satuan = $request->satuan;
            $data->save();

        return redirect('logistik/data-stok-barang')->with('sukses','Data Berhasil Ditambahkan');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('pages.logistik.datastokbarang.edit',[
            'item'=>$item
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
            'nama_barang'=>['required','string','max:255'],
            'satuan'=>['required','string','in:dus,sak,buah,unit,pcs'],
            ]);

        $data = $request->all();
        $item = StokBarang::findOrFail($id);

        $item ->update($data);
        return redirect('logistik/data-stok-barang')->with('edit','Data Berhasil Di Ubah');
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
        return redirect()->route('data-stok-barang.index')->with('dihapus','Data Berhasil Dihapus');
    }
}
