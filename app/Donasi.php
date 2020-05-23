<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\LogistikModel\UangMasuk;
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
        'id_donasi','user_id','jenis_donasi','status_verifikasi','keterangan_donasi','foto_bukti','tanggal_donasi','id_aktivitas_donasi'
    ,'nama_donatur'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function aktivitasdonasi(){
        return $this->belongsTo(AktivitasDonasi::class, 'id_aktivitas_donasi', 'id_aktivitas_donasi')->withTrashed();
    }

    public function uangmasuk(){
        return $this->hasOne(UangMasuk::class, 'id_donasi', 'id_donasi');
    }

    public function barangmasuk(){
        return $this->hasMany(BarangMasuk::class, 'id_donasi', 'id_donasi');
    }

    
}
