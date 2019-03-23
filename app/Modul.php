<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    public $table = 'modul';

    public function matkul(){
        return $this->belongsTo('App\Matkul', 'id_mk', 'id');
    }
}
