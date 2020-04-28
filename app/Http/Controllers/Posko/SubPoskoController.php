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
    public function index()
    {    


            $infoposko = InfoPosko::with('subposko')->where('user_id', Auth::user()->user_id)->get();
                $items = SubPosko::with('info_posko')->get();
                return view('pages.posko.subposko.index', [
                    'items'=>$items,
                    'infoposko'=> $infoposko
                ]);

                

              
            
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $info_posko = InfoPosko::where('user_id', Auth::user()->user_id)->get();
        return view ('pages.posko.subposko.create',[
            'info_posko'=>$info_posko
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
            'id_info_posko'=>['required'],
            'nama_sub_posko'=>['required','max:255','string'],
            'nama_penanggung_jawab'=>['required','string','max:255'],
        ],[
            'id_info_posko.required'=> 'Tidak boleh kosong',
            'nama_sub_posko.required'=> 'Nama sub posko tidak boleh kosong',
            'nama_penanggung_jawab.required'=> 'Nama penanggung jawab tidak boleh kosong'
        ]);

        $config=[
                'table'=>'sub_posko','field'=>'id_sub_posko','length'=> 10,'prefix'=>'SUB-'
            ];
            $id = IdGenerator::generate($config);


            $data = $request->all();
            $data['id_sub_posko']= $id.mt_rand(1,100).Auth::user()->user_id;
    
            SubPosko::create($data);
    
        return redirect('posko/sub-posko')->with('sukses','Data Berhasil Ditambahkan');
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
        $item = SubPosko::findOrFail($id);
        $info_posko = InfoPosko::where('user_id', Auth::user()->user_id)->get();
        return view('pages.posko.subposko.edit',[
            'item'=>$item,
            'info_posko'=>$info_posko
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
            'id_info_posko'=>['required'],
            'nama_sub_posko'=>['required','max:255','string'],
            'nama_penanggung_jawab'=>['required','string','max:255'],
        ],[
            'id_info_posko.required'=> 'Tidak boleh kosong',
            'nama_sub_posko.required'=> 'Nama sub posko tidak boleh kosong',
            'nama_penanggung_jawab.required'=> 'Nama penanggung jawab tidak boleh kosong'
        ]);

        $data = $request->all();
        $item = SubPosko::findOrFail($id);

        $item ->update($data);
        return redirect('posko/sub-posko')->with('edit','Data Berhasil Di Ubah');
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
        return redirect()->route('sub-posko.index')->with('hapus','Data Berhasil Dihapus');
    }
}
