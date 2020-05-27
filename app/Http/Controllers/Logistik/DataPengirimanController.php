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
        $pengiriman = PengirimanBarang::with(['permintaanbarang.infoposko.user'])->findOrFail($id_pengiriman);
        $items = DetailPengirimanBarang::with('stokbarang','pengirimanbarang')->where('id_pengiriman_barang',$id_pengiriman)->get();
        return view('pages.logistik.datapengiriman.detail',[
            'items'=>$items,
            'pengiriman'=>$pengiriman
        ]);
    }

    
    public function create(Request $request, $id)
    {
      $permintaan = PermintaanBarang::with(['infoposko.user'])->findOrFail($id);
      $items = StokBarang::where('quantity', '>', 0)->get();
      $detail = DetailPermintaanBarang::where('id_permintaan_barang', $id)->get();

      $config=[
        'table'=>'pengiriman_barang','field'=>'id_pengiriman_barang','length'=> 12,'prefix'=>'DLV-'.date('ym'),
        'reset_on_prefix_change'=>true
    ];
    $id_pengiriman = IdGenerator::generate($config);  
    $id = $id_pengiriman.$permintaan->infoposko->user->user_id;

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

        // $max = StokBarang::where('id_stok_barang', $request->id_stok_barang)->first();
        // $nilai_max = $max->quantity;

        if(count($request->id_stok_barang) > 0){

         
            foreach ($request->id_stok_barang as $item=>$v)
            {
                $config=[
                    'table'=>'detail_pengiriman_barang','field'=>'id_detail_pengiriman_barang','length'=> 14,'prefix'=>'D-DLV-'
                    .date('ym'), 'reset_on_prefix_change'=>true
                ];
                $id_detail = IdGenerator::generate($config);  

                $item_permintaan2 = PermintaanBarang::with(['infoposko.user'])->findOrFail($id_permintaan);

                $detail[] = array(
                    'id_detail_pengiriman_barang' => $id_detail.mt_rand(10,99).($item_permintaan2->infoposko->user->user_id+ mt_rand(10,99)), 
                    'id_pengiriman_barang' => $id_pengiriman,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
             
               
                // if ($request->jumlah[$item] > $nilai_max ){
                //     return back()->with(['error'=> 'Jumlah yang diinput melebihi jumlah stok']);
                // } 
              
            }
          
            for($i=0; $i < count($detail); $i++){
                 $max = StokBarang::where('id_stok_barang', $detail[$i]['id_stok_barang'])->first();
          
                if ($detail[$i]['jumlah'] > $max->quantity ){
                return back()->with(['error'=> 'Jumlah yang diinput melebihi jumlah stok']);
              
              } 
            
            }
         
          

          
            foreach($request->id_stok_barang as $item=>$v){
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
 
    
  
}
