<?php

namespace App\LogistikModel;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangMasuk extends Model
{
    use SoftDeletes;
    protected $table = 'barang_masuk';
    public $incrementing = false;
    protected $primaryKey = 'id_barang_masuk';
    protected $keyType = 'string';
    protected $fillable = [
        'id_barang_masuk', 'tanggal_barang_masuk', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function detailBarangMasuk()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'id_barang_masuk', 'id_barang_masuk');
    }
}
