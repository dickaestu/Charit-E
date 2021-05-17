<?php

namespace App\Http\Controllers\Posko;

use App\Http\Controllers\Controller;
use App\AdminModel\JenisBencana;
use App\Notifications\InfoKorban;
use App\PoskoModel\InfoPosko;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class InfoPoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = InfoPosko::with(['jenis_bencana', 'user', 'aktivitas_donasi'])->where('user_id', Auth::user()->user_id)->get(); //memanggil relasi yang sudah dibuat di model

        return view('pages.posko.infoposko.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_bencana = JenisBencana::all();
        return view('pages.posko.infoposko.create', [
            'jenis_bencana' => $jenis_bencana
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
            'tanggal_kejadian' => ['required', 'date'],
            'alamat_posko' => ['required', 'max:180', 'string'],
            'lokasi_bencana' => ['required', 'max:150', 'string'],
            'jumlah_korban' => ['required', 'integer'],
            'jumlah_korban_jiwa' => ['required', 'integer'],
            'id_jenis_bencana' => ['required'],
            'nama_penanggung_jawab' => ['required', 'string', 'max:100'],
            'no_hp_penanggung_jawab' => ['required', 'min:10', 'max:14'],
        ], [
            'tanggal_kejadian.date' => 'Silahkan masukkan tanggal dengan benar',
            'tanggal_kejadian.required' => 'Tanggal tidak boleh kosong',
            'lokasi_bencana.required' => 'Lokasi bencana tidak boleh kosong',
            'jumlah_korban.required' => 'Jumlah korban tidak boleh kosong',
            'jumlah_korban_jiwa.required' => 'Jumlah korban jiwa tidak boleh kosong',
            'id_jenis_bencana.required' => 'Jenis bencana belum dipilih',
            'nama_penanggung_jawab.required' => 'Wajib Diisi',
            'nama_penanggung_jawab.max' => 'Maksimal 100 Karakter',
        ]);

        $config = [
            'table' => 'info_posko', 'field' => 'id_info_posko', 'length' => 13, 'prefix' => 'INFO-',
            'reset_on_prefix_change' => true
        ];
        $id = IdGenerator::generate($config);


        $data = $request->all();
        $data['id_info_posko'] = $id;
        $data['user_id'] = Auth::user()->user_id;

        InfoPosko::create($data);

        return redirect('posko/info-posko')->with('sukses', 'Data Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $item = InfoPosko::with(['user', 'jenis_bencana'])->findOrFail($id);
        $jenis_bencana = JenisBencana::all();
        return view('pages.posko.infoposko.edit', [
            'item' => $item,
            'jenis_bencana' => $jenis_bencana
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
            'tanggal_kejadian' => ['required', 'date'],
            'alamat_posko' => ['required', 'max:180', 'string'],
            'lokasi_bencana' => ['required', 'max:150', 'string'],
            'jumlah_korban' => ['required', 'integer'],
            'jumlah_korban_jiwa' => ['required', 'integer'],
            'id_jenis_bencana' => ['required'],
            'nama_penanggung_jawab' => ['required', 'string', 'max:100'],
            'no_hp_penanggung_jawab' => ['required', 'min:10', 'max:14'],


        ], [
            'tanggal_kejadian.date' => 'Silahkan masukkan tanggal dengan benar',
            'tanggal_kejadian.required' => 'Tanggal tidak boleh kosong',
            'lokasi_bencana.required' => 'Lokasi bencana tidak boleh kosong',
            'jumlah_korban.required' => 'Jumlah korban tidak boleh kosong',
            'jumlah_korban_jiwa.required' => 'Jumlah korban jiwa tidak boleh kosong',
            'id_jenis_bencana.required' => 'Jenis bencana belum dipilih',
            'nama_penanggung_jawab.required' => 'Wajib Diisi',
            'nama_penanggung_jawab.max' => 'Maksimal 100 Karakter',
        ]);

        $data = $request->all();
        $item = InfoPosko::findOrFail($id);

        $item->update($data);

        $item->notify(new InfoKorban($item));

        return redirect('posko/info-posko')->with('edit', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = InfoPosko::findOrFail($id);
        $item->delete();
        return redirect()->route('info-posko.index')->with('hapus', 'Data Berhasil Dihapus');
    }
}
