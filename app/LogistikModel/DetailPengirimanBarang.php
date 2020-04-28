<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\LogistikModel\PengirimanBarang;
use App\LogistikModel\StokBarang;

class DetailPengirimanBarang extends Model
{
    use SoftDeletes;

    protected $table = 'detail_pengiriman_barang';
    protected $primaryKey = 'id_detail_pengiriman_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_detail_pengiriman_barang','id_pengiriman_barang','id_stok_barang',
        'jumlah'
    ];

    public function stokbarang(){
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang');
    }

    public function pengirimanbarang(){
        return $this->belongsTo(PengirimanBarang::class, 'id_pengiriman_barang', 'id_pengiriman_barang');
    }
}
