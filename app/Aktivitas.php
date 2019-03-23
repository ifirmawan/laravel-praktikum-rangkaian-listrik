<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    public $table = 'aktivitas';

    public function matkul()
    {
        return $this->belongsTo('App\Matkul', 'id_mk', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas', 'id');
    }

    public function peserta()
    {
        return $this->belongsTo('App\Peserta', 'id_aktivitas');
    }
}
