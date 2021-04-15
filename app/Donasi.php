<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\LogistikModel\BarangMasuk;
use App\AdminModel\AktivitasDonasi;
use Illuminate\Database\Eloquent\SoftDeletes;


class Donasi extends Model
{

    use SoftDeletes;
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';
    protected $keyType = 'string';
    protected $fillable = [
        'id_donasi', 'user_id', 'status_verifikasi', 'keterangan_donasi', 'foto_bukti', 'tanggal_donasi', 'id_aktivitas_donasi', 'is_anonim'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function aktivitasdonasi()
    {
        return $this->belongsTo(AktivitasDonasi::class, 'id_aktivitas_donasi', 'id_aktivitas_donasi');
    }

    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_donasi', 'id_donasi');
    }
}
