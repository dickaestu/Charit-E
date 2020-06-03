<?php

namespace App\PoskoModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PoskoModel\PenerimaanBarang;
use App\LogistikModel\StokBarang;

class DetailPenerimaanBarang extends Model
{
    use SoftDeletes;

    protected $table = 'detail_penerimaan_barang';
    protected $primaryKey = 'id_detail_penerimaan_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_detail_penerimaan_barang','id_penerimaan_barang','id_stok_barang',
        'jumlah'
    ];

    public function stokbarang(){
        return $this->belongsTo(StokBarang::class, 'id_stok_barang', 'id_stok_barang')->withTrashed();
    }

    public function penerimaanbarang(){
        return $this->belongsTo(PenerimaanBarang::class, 'id_penerimaan_barang', 'id_penerimaan_barang');
    }
}
