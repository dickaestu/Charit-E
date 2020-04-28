<?php

namespace App\PoskoModel;

use App\PoskoModel\InfoPosko;
use App\PoskoModel\DetailPermintaanBarang;
use App\LogistikModel\PengirimanBarang;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermintaanBarang extends Model
{
    use SoftDeletes;

    protected $table = 'permintaan_barang';
    protected $primaryKey = 'id_permintaan_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_permintaan_barang','id_info_posko','keterangan_permintaan','status_permintaan','status_pengiriman',
        'tanggal_permintaan','status_penerimaan'
    ];

    public function infoposko(){
        return $this->belongsTo(InfoPosko::class, 'id_info_posko', 'id_info_posko');
    }

    public function detailpermintaanbarang(){
        return $this->hasMany(DetailPermintaanBarang::class, 'id_permintaan_barang', 'id_permintaan_barang');
    }

    public function pengirimanbarang(){
        return $this->hasOne(PengirimanBarang::class, 'id_permintaan_barang', 'id_permintaan_barang');
    }
}
