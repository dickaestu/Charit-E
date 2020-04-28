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
        $infoposko = InfoPosko::where('user_id', Auth::user()->user_id)->get();
        $items = PermintaanBarang::with(['infoposko','pengirimanbarang'])->get();

        return view('pages.posko.datapermintaan.index',[
            'items'=>$items,
            'infoposko'=>$infoposko,
        ]);
    }

    public function tambah(Request $request)
    {
        

        $infoposko = InfoPosko::where('user_id', Auth::user()->user_id)->get();
        $stokbarang = StokBarang::where('quantity','>', 0)->get();
        $config=[
            'table'=>'permintaan_barang','field'=>'id_permintaan_barang','length'=> 8,'prefix'=>'REQ-'
        ];
        $id_permintaan = IdGenerator::generate($config);  
        $id = $id_permintaan.mt_rand(1,99).Auth::user()->user_id;
     
        
        return view('pages.posko.datapermintaan.tambah',[
            'infoposko'=> $infoposko,
            'stokbarang'=>$stokbarang,
            'id_permintaan'=>$id
        ]);
    }



    public function prosestambah(Request $request, $id_permintaan)
    {
        
        $request->validate([
            'id_info_posko'=>['required','exists:info_posko,id_info_posko'],
            'id_stok_barang'=>['required','exists:stok_barang,id_stok_barang'],
            'jumlah'=>['required','min:1'],
            'keterangan_permintaan'=>['required','string','max:150'],
        ], [
            'id_info_posko.required' => 'Anda belum memilih lokasi bencana',
            'id_info_posko.exists' => 'Anda belum memilih lokasi bencana',
            'keterangan_permintaan.required' => 'Keterangan tidak boleh kosong',
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required'=> 'Tidak boleh kosong'
        ]);

        $data = new PermintaanBarang;
        $data->id_permintaan_barang = $id_permintaan;
        $data->id_info_posko= $request->id_info_posko;
        $data->keterangan_permintaan= $request->keterangan_permintaan;
        $data->status_permintaan = 'PENDING';
        $data->status_penerimaan = false;
        $data->status_pengiriman = false;
        $data->tanggal_permintaan = Carbon::now();
        $data->save();



        $config=[
            'table'=>'detail_permintaan_barang','field'=>'id_detail_permintaan_barang','length'=> 7,'prefix'=>'DP-'
        ];
        $id_detail = IdGenerator::generate($config);  

        if(count($request->id_stok_barang) > 0){

            foreach ($request->id_stok_barang as $item=>$v)
            {
                $detail[] = array(
                    'id_detail_permintaan_barang' => $id_detail.mt_rand(10,99).Auth::user()->user_id, 
                    'id_permintaan_barang' => $id_permintaan,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
                
            }
            DetailPermintaanBarang::insert($detail);
        }
        return redirect('/posko')->with('sukses','Permintaan Berhasil Data Akan Segera Di Proses');
        
       
    }

    public function detailpermintaan(Request $request, $id)
    {
        $items = DetailPermintaanBarang::with(['stokbarang'])->where('id_permintaan_barang', $id)->get();
        return view('pages.posko.datapermintaan.detailpermintaan',[
            'items'=>$items
        ]);
    }
  
    public function hapus($id)
    {
        $item = PermintaanBarang::findOrFail($id);
        $detail = DetailPermintaanBarang::where('id_permintaan_barang', $id)->delete();

        $item->delete();

        return redirect('/posko');
    }
}
