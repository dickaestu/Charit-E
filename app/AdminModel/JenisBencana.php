<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisBencana extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_bencana';

    protected $primaryKey = 'id_jenis_bencana';
    protected $keyType = 'string';

    protected $fillable = [
       'id_jenis_bencana', 'nama_bencana'
    ];

    protected $hidden = [
        
    ];

    public function info_posko(){
        return $this->hasMany(InfoPosko::class, 'id_jenis_bencana', 'id_jenis_bencana');
    }
}
