<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\LogistikModel\PengeluaranUang;
use App\LogistikModel\StokBarang;

class DetailPengeluaranUang extends Model
{
    use SoftDeletes;

    protected $table = 'detail_pengeluaran_uang';
    protected $primaryKey = 'id_detail_pengeluaran_uang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_detail_pengeluaran_uang','id_pengeluaran_uang','id_stok_barang',
        'jumlah','nominal'
    ];

    public function stokbarang(){
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang')->withTrashed();
    }

    public function pengeluaranuang(){
        return $this->belongsTo(PengeluaranUang::class, 'id_pengeluaran_uang', 'id_pengeluaran_uang');
    }
}
