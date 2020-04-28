<?php

namespace App\PoskoModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PoskoModel\DetailPenerimaanBarang;
use App\LogistikModel\PengirimanBarang;

class PenerimaanBarang extends Model
{
    use SoftDeletes;

    protected $table = 'penerimaan_barang';
    protected $primaryKey = 'id_penerimaan_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_penerimaan_barang','id_pengiriman_barang','keterangan_penerimaan','status_penerimaan','status_pengiriman',
        'tanggal_penerimaan'
    ];

   

    public function detailpenerimaanbarang(){
        return $this->hasMany(DetailPenerimaanBarang::class, 'id_penerimaan_barang', 'id_penerimaan_barang');
    }

    public function pengirimanbarang(){
        return $this->belongsTo(PengirimanBarang::class, 'id_pengiriman_barang', 'id_pengiriman_barang');
    }
}
