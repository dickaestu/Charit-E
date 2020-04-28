<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use App\Donasi;
use App\LogistikModel\StokBarang;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangMasuk extends Model
{
    use SoftDeletes;
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $keyType = 'string';
    protected $fillable = [
        'id_barang_masuk','id_donasi','id_stok_barang','jumlah','tanggal_barang_masuk'
    ];

    public function donasi(){
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }

    public function stokbarang(){
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang')->withTrashed();
    }
}
