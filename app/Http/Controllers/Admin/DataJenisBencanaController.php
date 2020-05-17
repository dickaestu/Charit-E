<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\AdminModel\JenisBencana;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;

class DataJenisBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = JenisBencana::all();
        return view('pages.admin.datajenisbencana.index', ['items'=>$items]);
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
            'nama_bencana'=>['required','string','max:255']
            ]);

            $config=[
                'table'=>'jenis_bencana','field'=>'id_jenis_bencana','length'=> 4,'prefix'=>'B'
            ];
            $id = IdGenerator::generate($config);
            $data = $request->all();
            $data['id_jenis_bencana'] = $id;    
            JenisBencana::create($data);

    return redirect('admin/data-jenis-bencana')->with('sukses','Data Berhasil Ditambahkan');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = JenisBencana::findOrFail($id);
        $item->delete();
        return redirect()->route('data-jenis-bencana.index')->with('dihapus','Data Berhasil Dihapus');
    }
}
