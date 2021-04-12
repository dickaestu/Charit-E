<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use App\LogistikModel\BarangMasuk;
use App\LogistikModel\DetailPengirimanBarang;
use App\PoskoModel\DetailPermintaanBarang;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokBarang extends Model
{
    use SoftDeletes;
    protected $table = 'stok_barang';
    protected $primaryKey = 'id_stok_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'kode_barang', 'nama_barang', 'quantity', 'satuan', 'deskripsi_barang'
    ];

    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_stok_barang', 'id_stok_barang');
    }

    public function detail_permintaan_barang()
    {
        return $this->hasMany(DetailPermintaanBarang::class, 'id_stok_barang', 'id_stok_barang');
    }

    public function detail_pengiriman_barang()
    {
        return $this->hasMany(DetailPengirimanBarang::class, 'id_stok_barang', 'id_stok_barang');
    }
}
