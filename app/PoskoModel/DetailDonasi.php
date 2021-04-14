<?php

namespace App\PoskoModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailDonasi extends Model
{
    use SoftDeletes;
    protected $table = 'detail_donasi';
    protected $primaryKey = 'id_detail_donasi';
    protected $keyType = 'string';
    protected $fillable = [
        'id_detail_donasi', 'id_donasi', 'id_stok_barang', 'jumlah', 'tanggal_donasi_masuk'
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }

    public function stokbarang()
    {
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang')->withTrashed();
    }
}
