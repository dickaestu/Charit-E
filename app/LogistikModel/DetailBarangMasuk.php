<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailBarangMasuk extends Model
{
    use SoftDeletes;
    protected $table = 'detail_barang_masuk';
    protected $primaryKey = 'id_detail_barang_masuk';
    protected $fillable = [
        'id_detail_barang_masuk', 'id_barang_masuk', 'jumlah', 'id_stok_barang'
    ];

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang');
    }

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_barang_masuk', 'id_barang_masuk');
    }
}
