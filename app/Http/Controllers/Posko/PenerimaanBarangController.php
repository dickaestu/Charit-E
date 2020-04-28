<?php

namespace App\Http\Controllers\Posko;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\LogistikModel\StokBarang;
use App\PoskoModel\PenerimaanBarang;
use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\DetailPenerimaanBarang;
use App\LogistikModel\PengirimanBarang;
use Auth;

class PenerimaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id_permintaan)
    {
        $id_pengiriman = PengirimanBarang::where('id_permintaan_barang',$id_permintaan)->get();
        foreach($id_pengiriman as $id){
        if ($id->id_permintaan_barang == $id_permintaan){
            $stok = StokBarang::where('quantity','>', 0)->get();

            $config=[
                'table'=>'penerimaan_barang','field'=>'id_penerimaan_barang','length'=> 10,'prefix'=>'CONF-'
            ];
            $id_penerimaan = IdGenerator::generate($config);  
            $id = $id_penerimaan.mt_rand(10,99).Auth::user()->user_id;

            $id_permintaan= $id_permintaan;
        
            return view('pages.posko.createpenerimaan',[
                'stokbarang'=>$stok,
                'id_pengiriman'=>$id_pengiriman,
                'id_penerimaan'=>$id,
                'id_permintaan'=>$id_permintaan
            ]);
        }
    }
        return redirect('/posko')->with(['error'=> 'Mohon Maaf, Anda Belum Bisa Membuat Laporan Karena Barang Belum Dikirim']);
    }

    
    public function store(Request $request,$id_permintaan, $id)
    {
        $request->validate([
            'id_stok_barang'=>['required','exists:stok_barang,id_stok_barang'],
            'jumlah'=>['required'],
            'keterangan_penerimaan'=>['required','string','max:250'],
        ], [
            'keterangan_penerimaan.required' => 'Keterangan tidak boleh kosong',
            'id_stok_barang.required' => 'Anda belum memilih barang',
            'id_stok_barang.exists' => 'Anda belum memilih barang',
            'jumlah.required'=> 'Tidak boleh kosong'
        ]);

        $data = new PenerimaanBarang;
        $data->id_penerimaan_barang = $id;
        $data->id_pengiriman_barang= $request->id_pengiriman_barang;
        $data->keterangan_penerimaan= $request->keterangan_penerimaan;
        $data->tanggal_penerimaan = Carbon::now();
        $data->save();

        $config=[
            'table'=>'detail_penerimaan_barang','field'=>'id_detail_penerimaan_barang','length'=> 9,'prefix'=>'DT-'
        ];
        $id_detail = IdGenerator::generate($config);  

        if(count($request->id_stok_barang) > 0){

            foreach ($request->id_stok_barang as $item=>$v)
            {
                $detail[] = array(
                    'id_detail_penerimaan_barang' => $id_detail.mt_rand(10,99).Auth::user()->user_id, 
                    'id_penerimaan_barang' => $id,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah_penerimaan' => $request->jumlah[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );
                
            }
            DetailPenerimaanBarang::insert($detail);
            $data2['status_penerimaan'] = true;
            $item2 = PermintaanBarang::findOrFail($id_permintaan);
            $item2->update($data2);
        }
        return redirect('/posko')->with('penerimaan','Laporan Penerimaan Telah Di Buat');
    }

    public function detailpenerimaan(Request $request, $id)
    {
        $permintaan = PermintaanBarang::findOrFail($id);
        $pengiriman = PengirimanBarang::where('id_permintaan_barang',$permintaan->id_permintaan_barang)->get();
        foreach($pengiriman as $kirim){
            $penerimaan = PenerimaanBarang::where('id_pengiriman_barang', $kirim->id_pengiriman_barang)->get();
            
            foreach($penerimaan as $terima){
                $items = DetailPenerimaanBarang::with(['stokbarang'])->where('id_penerimaan_barang', $terima->id_penerimaan_barang)->get();
                return view('pages.posko.detailpenerimaan',[
                    'items'=>$items
                ]);
            }
        }
      
       
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
