<?php

namespace App\PoskoModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PoskoModel\PermintaanBarang;
use App\LogistikModel\StokBarang;

class DetailPermintaanBarang extends Model
{
    use SoftDeletes;

    protected $table = 'detail_permintaan_barang';
    protected $primaryKey = 'id_detail_permintaan_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_detail_permintaan_barang','id_permintaan_barang','id_stok_barang',
        'jumlah'
    ];

    public function stokbarang(){
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang');
    }

    public function permintaanbarang(){
        return $this->belongsTo(PermintaanBarang::class, 'id_permintaan_barang', 'id_permintaan_barang');
    }
}
