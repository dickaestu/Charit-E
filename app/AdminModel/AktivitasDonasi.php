<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;
use App\PoskoModel\InfoPosko;
use App\Donasi;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktivitasDonasi extends Model
{
    use SoftDeletes;
    protected $table = 'aktivitas_donasi';
    protected $primaryKey = 'id_aktivitas_donasi';
    protected $keyType = 'string';
    protected $fillable = [
        'id_aktivitas_donasi', 'id_info_posko', 'foto_aktivitas', 'keterangan_aktivitas', 'is_active'
    ];

    public function info_posko()
    {
        return $this->belongsTo(InfoPosko::class, 'id_info_posko', 'id_info_posko');
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_aktivitas_donasi', 'id_aktivitas_donasi');
    }
}
