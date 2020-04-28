<?php

namespace App\PoskoModel;


use Illuminate\Database\Eloquent\Model;
use App\PoskoModel\InfoPosko;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubPosko extends Model
{
    use SoftDeletes;

    protected $table = 'sub_posko';
    protected $primaryKey = 'id_sub_posko';
    protected $keyType = 'string';
    protected $fillable = [
        'id_info_posko','id_sub_posko','nama_sub_posko','nama_penanggung_jawab'
    ];

    public function info_posko(){
        return $this->belongsTo(InfoPosko::class, 'id_info_posko', 'id_info_posko');
    }

}
