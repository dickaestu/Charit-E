<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPermintaanBarang;
use App\LogistikModel\StokBarang;
use App\LogistikModel\PengirimanBarang;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\LogistikModel\DetailPengirimanBarang;
use Carbon\Carbon;

class DataPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = PengirimanBarang::with('detailpengirimanbarang','permintaanbarang')->get();
        return view('pages.logistik.datapengiriman.index',[
            'items'=>$items
        ]);
    }

    public function detailpengiriman(Request $request, $id_pengiriman)
    {
        $pengiriman = PengirimanBarang::findOrFail($id_pengiriman);
        $items = DetailPengirimanBarang::with('stokbarang','pengirimanbarang')->where('id_pengiriman_barang',$id_pengiriman)->get();
        return view('pages.logistik.datapengiriman.detail',[
            'items'=>$items,
            'pengiriman'=>$pengiriman
        ]);
    }

    
    public function create(Request $request, $id)
    {
      $permintaan = PermintaanBarang::findOrFail($id);
      $items = StokBarang::where('quantity', '>', 0)->get();
      $detail = DetailPermintaanBarang::where('id_permintaan_barang', $id)->get();

      $config=[
        'table'=>'pengiriman_barang','field'=>'id_pengiriman_barang','length'=> 8,'prefix'=>'DLVR-'
    ];
    $id_pengiriman = IdGenerator::generate($config);  
    $id = $id_pengiriman.mt_rand(100,999).$permintaan->infoposko->user->user_id;

      return view('pages.logistik.datapermintaan.create',[
          'permintaan'=> $permintaan,
          'stokbarang'=>$items,
          'detail'=>$detail,
          'id_pengiriman'=>$id
      ]);
    }

    public function prosestambah(Request $request, $id_permintaan, $id_pengiriman)
    {   
        $request->validate([
            'id_stok_barang'=>['required','exists:stok_barang,id_stok_barang'],
            'jumlah'=>['required','min:1'],
            'keterangan_pengiriman'=>['required','string','max:150'],
        ], [
            'keterangan_permintaan.required' => 'Keterangan tidak boleh kosong',
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required'=> 'Tidak boleh kosong',
            
        ]);

        $max = StokBarang::where('id_stok_barang', $request->id_stok_barang)->first();
        $nilai_max = $max->quantity;

        if(count($request->id_stok_barang) > 0){

         
            foreach ($request->id_stok_barang as $item=>$v)
            {
                $config=[
                    'table'=>'detail_pengiriman_barang','field'=>'id_detail_pengiriman_barang','length'=> 10,'prefix'=>'DDLVRY-'
                ];
                $id_detail = IdGenerator::generate($config);  

                $item_permintaan2 = PermintaanBarang::findOrFail($id_permintaan);

                $detail[] = array(
                    'id_detail_pengiriman_barang' => $id_detail.mt_rand(10,99).$item_permintaan2->infoposko->user->user_id, 
                    'id_pengiriman_barang' => $id_pengiriman,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );

                if ($request->jumlah[$item] > $nilai_max ){
                    return back()->with(['error'=> 'Jumlah yang diinput melebihi jumlah stok']);
                } 
                
                
                $stokbarang = StokBarang::where('id_stok_barang',$request->id_stok_barang[$item])->get();
                
                foreach($stokbarang as $stok){
                $stok->quantity -= $request->jumlah[$item];
                $stok->save(); 
                }
           
            }

            $data = new PengirimanBarang;
            $data->id_pengiriman_barang = $id_pengiriman;
            $data->id_permintaan_barang = $id_permintaan;
            $data->keterangan_pengiriman= $request->keterangan_pengiriman;
            $data->tanggal_pengiriman = Carbon::now();
            $data->save();

            DetailPengirimanBarang::insert($detail);
              
            
        }

        $permintaan['status_pengiriman'] = true;
            $item_permintaan = PermintaanBarang::findOrFail($id_permintaan);
            $item_permintaan->update($permintaan);
        

        return redirect('/logistik/data-pengiriman')->with(['sukses'=> 'Data Pengiriman Berhasil Di Buat']);    
    }
 
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
