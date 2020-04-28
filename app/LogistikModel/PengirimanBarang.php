<?php

namespace App\LogistikModel;

use App\PoskoModel\PermintaanBarang;
use App\PoskoModel\PenerimaanBarang;
use App\LogistikModel\DetailPengirimanBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengirimanBarang extends Model
{
    use SoftDeletes;

    protected $table = 'pengiriman_barang';
    protected $primaryKey = 'id_pengiriman_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_pengiriman_barang','id_permintaan_barang','keterangan_pengiriman',
        'tanggal_pengiriman'
    ];

    public function permintaanbarang(){
        return $this->belongsTo(PermintaanBarang::class, 'id_permintaan_barang', 'id_permintaan_barang');
    }

    public function detailpengirimanbarang(){
        return $this->hasMany(DetailPengirimanBarang::class, 'id_pengiriman_barang', 'id_pengiriman_barang');
    }

    public function penerimaanbarang(){
        return $this->hasOne(PenerimaanBarang::class, 'id_penerimaan_barang', 'id_penerimaan_barang');
    }
}
