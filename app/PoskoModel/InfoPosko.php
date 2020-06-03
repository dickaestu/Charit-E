<?php

namespace App\PoskoModel;

use App\AdminModel\JenisBencana;
use App\PoskoModel\SubPosko;
use App\PoskoModel\PermintaanBarang;
use App\User;
use App\AdminModel\AktivitasDonasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoPosko extends Model
{
    use SoftDeletes;

    protected $table = 'info_posko';
    protected $primaryKey = 'id_info_posko';
    protected $keyType = 'string';
    protected $fillable = [
        'id_info_posko','user_id','id_jenis_bencana','alamat_posko',
        'jumlah_korban', 'jumlah_korban_jiwa', 'lokasi_bencana', 'tanggal_kejadian'
    ];

    public function jenis_bencana(){
        return $this->belongsTo(JenisBencana::class, 'id_jenis_bencana', 'id_jenis_bencana')->withTrashed();
    }

    public function aktivitas_donasi(){
        return $this->hasOne(AktivitasDonasi::class, 'id_info_posko', 'id_info_posko');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id')->withTrashed();
    }

    public function subposko(){
        return $this->hasMany(SubPosko::class, 'id_info_posko', 'id_info_posko');
    }

    public function permintaanbarang(){
        return $this->hasMany(PermintaanBarang::class, 'id_info_posko', 'id_info_posko');
    }
}
