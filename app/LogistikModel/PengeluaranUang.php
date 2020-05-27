<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use App\LogistikModel\DetailPengeluaranUang;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengeluaranUang extends Model
{
    use SoftDeletes;

    protected $table = 'pengeluaran_uang';
    protected $primaryKey = 'id_pengeluaran_uang';
    protected $keyType = 'string';
    protected $fillable = [
        'id_pengeluaran_uang','total_pengeluaran','keterangan_pengeluaran',
        'tanggal_pengeluaran'
    ];


    public function detail_pengeluaran(){
        return $this->hasMany(DetailPengeluaranUang::class, 'id_pengeluaran_uang', 'id_pengeluaran_uang');
    }
}
