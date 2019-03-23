<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    public $table = 'peserta';

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function aktivitas()
    {
        return $this->belongsTo('App\Aktivitas', 'id_aktivitas', 'id');
    }
}
