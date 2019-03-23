<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $table = 'laporan';

    public function getPdfURLAttribute()
    {
        return asset('file/'.$this->pdf);
    }

    public function asisten(){
        return $this->belongsTo('App\User', 'id_asisten', 'id');
    }



}
