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
        $id_aktivitas = AktivitasDonasi::findOrFail($id);

        $config=[
            'table'=>'donasi','field'=>'id_donasi','length'=> 10,'prefix'=>'DNS-'
        ];
        $id = IdGenerator::generate($config).mt_rand(1,1000).Auth::user()->user_id;

        $item = Auth::user();
        return view('pages.donasi.konfirmasi-donasi',[
            'item'=>$item,
            'id'=>$id,
            'id_aktivitas'=>$id_aktivitas
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
            'jenis_donasi'=>['required'],
            'keterangan_donasi'=>['required'],
            'foto_bukti'=>['required','image','mimes:jpg,png,jpeg']
        ],[
            'foto_bukti.image'=> 'Yang anda masukkan bukan gambar',
            'foto_bukti.mimes'=> 'Format harus jpeg/png/jpeg',
            'keterangan_donasi.required'=> 'Keterangan/nominal harus diisi',
            ]);

           $nama; 
           if($request->nama_donatur_anonim !=null){
                    $nama='Anonim';
            } else { $nama= $request->nama_donatur;
            }


            Donasi::create([
            'id_donasi'=> $request->id_donasi,
            'id_aktivitas_donasi'=>$id,
            'user_id'=> Auth::user()->user_id,
            'nama_donatur'=> $nama,
            'status_verifikasi'=> false,
            'jenis_donasi'=>$request->jenis_donasi,
            'keterangan_donasi'=> $request->keterangan_donasi,
            'foto_bukti'=>$request->file('foto_bukti')->store(
                'assets/gallery', 'public'),
            'tanggal_donasi'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return  redirect()->route('sukses',$id);
    }

    public function sukses()
    {
        return view('pages.donasi.sukses');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
