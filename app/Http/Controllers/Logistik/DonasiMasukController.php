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
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

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
        return view('pages.logistik.donasimasuk.index',[
            'items'=>$item
        ]);
    }

    public function verifikasibarang(Request $request, $id)
    {
        $donasi = $id;
        $stokbarang = StokBarang::all();
        return view('pages.logistik.donasimasuk.verifikasi',[
            'stokbarang'=>$stokbarang,
            'donasi'=>$donasi
        ]);
    }

    // public function tambahbarang(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_stok_barang'=>['required','exists:stok_barang,id_stok_barang'],
    //         'jumlah'=>['required','integer'],
    //     ], [
    //         'id_stok_barang.required' => 'Anda belum memilih barang',
    //         'id_stok_barang.exists' => 'Anda belum memilih barang',
    //         'jumlah.required'=> 'Tidak boleh kosong',
    //         'jumlah.integer'=> 'Harus angka'
    //     ]);
    //     $id_user = Donasi::findOrFail($id);
    //     $config=[
    //         'table'=>'barang_masuk','field'=>'id_barang_masuk','length'=> 10,'prefix'=>'BRGMSK-'
    //     ];
    //     $id_barang = IdGenerator::generate($config);  

    //     $data = $request->all();
    //     $data['id_barang_masuk'] = $id_barang.mt_rand(0,100).$id_user->user_id;
    //     $data['id_donasi']= $id;
    //     $data['tanggal_barang_masuk'] = Carbon::now();

    //     BarangMasuk::create($data);

    //     $stokbarang = StokBarang::findOrFail($request->id_stok_barang);

    //     $stokbarang->quantity += $request->jumlah;

    //     $stokbarang->save();

        
    //     return redirect()->route('verifikasi-barang',$id)->with('tambah','Data Berhasil Di Tambah');
    // }

    public function sukses(Request $request, $id)
    {
       

        $id_user = Donasi::findOrFail($id);

        $config=[
            'table'=>'barang_masuk','field'=>'id_barang_masuk','length'=> 10,'prefix'=>'BRGMSK-'
        ];
        $idBarangMasuk = IdGenerator::generate($config);  

        if(count($request->id_stok_barang) > 0){

            foreach ($request->id_stok_barang as $item=>$v)
            {
                $request->validate([
                    'id_stok_barang'=>['required','exists:stok_barang,id_stok_barang'],
                    'jumlah'=>['required'],
                ], [
                    'id_stok_barang.required' => 'Anda belum memilih barang',
                    'id_stok_barang.exists' => 'Anda belum memilih barang',
                    'jumlah.required'=> 'Tidak boleh kosong',
                ]);
                $detail[] = array(
                    'id_barang_masuk' => $idBarangMasuk.mt_rand(100,999).$id_user->user_id, 
                    'id_donasi' => $id,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
                
                $stokbarang = StokBarang::where('id_stok_barang',$request->id_stok_barang[$item])->get();
                
                foreach($stokbarang as $stok){
                $stok->quantity += $request->jumlah[$item];
                $stok->save(); 
                }

            }
            BarangMasuk::insert($detail);
        }

        $donasi = Donasi::findOrFail($id);

        $donasi->status_verifikasi = true;
        $donasi->save();

        return redirect()->route('donasi-masuk-logistik')->with('sukses','Verifikasi Berhasil');
    
    }













    public function verifikasiuang(Request $request, $id)
    {
        $item = Donasi::with(['user'])->findOrFail($id);
        return view('pages.logistik.donasimasuk.verifikasiuang',[
            'item'=> $item
        ]);
    }

    public function verifikasiuangcreate(Request $request, $ids)
    {
        $request->validate([
            'nominal'=>['required','integer'],
        ], [
            'nominal.required'=> 'Tidak boleh kosong',
            'nominal.integer'=> 'Harus angka'
        ]);

        $donasi = Donasi::findOrFail($ids);
        $donasi->status_verifikasi = true;
        $donasi->save();

        $config=[
            'table'=>'uang_masuk','field'=>'id_uang_masuk','length'=> 10,'prefix'=>'UMSK-'
        ];
        $id = IdGenerator::generate($config);

        

        $data = $request->all();
        $data['id_uang_masuk']= $id.mt_rand(0,100).$donasi->user_id;
        $data['id_donasi']= $ids;
        $data['tanggal_masuk']= Carbon::now();

        UangMasuk::create($data);
        return redirect()->route('donasi-masuk-logistik')->with('sukses','Verifikasi Berhasil');
        
        

    }


}
