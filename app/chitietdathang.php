<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietdathang extends Model
{
    public    $timestamps   = false;

    protected $table        = 'chitietdathang';
    protected $fillable     = ['ctdh_soluong', 'ctdh_dongia'];
    protected $guarded      = ['ddh_id', 'hh_id'];

    protected $primaryKey   = ['ddh_id', 'hh_id'];
   

    public function hanghoa(){
        return $this->belongsTo('App\hanghoa', 'hh_id', 'hh_id');
    }
    public function dondathang(){
        return $this->belongsTo('App\dondathang', 'ddh_id', 'ddh_id');
    }
}
