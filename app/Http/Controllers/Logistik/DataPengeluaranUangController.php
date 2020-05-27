<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LogistikModel\StokBarang;
use App\LogistikModel\PengeluaranUang;
use App\LogistikModel\DetailPengeluaranUang;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class DataPengeluaranUangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PengeluaranUang::all();
        $total = PengeluaranUang::sum('total_pengeluaran');
        return view('pages.logistik.datapengeluaran.index',compact('items','total'));
    }

    public function tambah()
    {
        $stokbarang = StokBarang::all();
        return view('pages.logistik.datapengeluaran.tambah',
            compact('stokbarang')
        );
    }

    public function create(Request $request)
    {
        
        $config=[
            'table'=>'pengeluaran_uang','field'=>'id_pengeluaran_uang','length'=> 16,'prefix'=>'M-OUT-'.date('ym'),
            'reset_on_prefix_change'=>true
        ];
        $id_pengeluaran = IdGenerator::generate($config);  

        if(count($request->id_stok_barang) > 0){
            $configg=[
                'table'=>'detail_pengeluaran_uang','field'=>'id_detail_pengeluaran_uang','length'=> 15,'prefix'=>'DM-OUT-'.date('ym'),
                'reset_on_prefix_change'=>true
            ];
            foreach ($request->id_stok_barang as $item=>$v)
            {
               
             $id = IdGenerator::generate($configg);  
                $request->validate([
                    'id_stok_barang'=>['required','exists:stok_barang,id_stok_barang'],
                    'jumlah'=>['required'],
                ], [
                    'id_stok_barang.required' => 'Anda belum memilih barang',
                    'id_stok_barang.exists' => 'Anda belum memilih barang',
                    'jumlah.required'=> 'Tidak boleh kosong',
                ]);
       
                $detail[] = [
                   'id_detail_pengeluaran_uang' => $id.mt_rand(100,999), 
                    'id_pengeluaran_uang' => $id_pengeluaran,
                    'id_stok_barang' => $request->id_stok_barang[$item],
                    'jumlah' => $request->jumlah[$item],
                    'nominal' => $request->nominal[$item],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

            
                
            }
        }


        $sum = 0;
        foreach($request->nominal as $key=>$value)
        {
           $sum+= $value;
        }
        
        
        
       
        foreach($request->id_stok_barang as $item=>$v){
            $stokbarang = StokBarang::where('id_stok_barang',$request->id_stok_barang[$item])->get();
            foreach($stokbarang as $stok){
            $stok->quantity += $request->jumlah[$item];
            $stok->save(); 
            }
        }

        $data = new PengeluaranUang;
        $data->id_pengeluaran_uang= $id_pengeluaran;
        $data->keterangan_pengeluaran = $request->keterangan_pengeluaran;
        $data->total_pengeluaran= $sum;
        $data->tanggal_pengeluaran = Carbon::now();
        $data->save();

        DetailPengeluaranUang::insert($detail);

        return redirect()->route('data-pengeluaran-logistik')->with('sukses','Data Berhasil Dibuat');
    
    }

    public function detail($id){
        $items = DetailPengeluaranUang::with('stokbarang')->where('id_pengeluaran_uang',$id)->get();
        $total = DetailPengeluaranUang::where('id_pengeluaran_uang',$id)->sum('nominal');
        return view('pages.logistik.datapengeluaran.detail',compact('items','total'));
    }

  
}
