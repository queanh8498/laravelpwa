<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietphieuxuat extends Model
{
    public    $timestamps   = false;

    protected $table        = 'chitietphieuxuat';
    protected $fillable     = ['ctpx_soluong', 'ctpx_dongia'];
    protected $guarded      = ['pxk_id', 'hh_id'];

    protected $primaryKey   = ['pxk_id', 'hh_id'];
 

    public function hanghoa(){
        return $this->belongsTo('App\hanghoa', 'hh_id', 'hh_id');
    }
    public function phieuxuatkho(){
        return $this->belongsTo('App\phieuxuatkho', 'pxk_id', 'pxk_id');
    }
}
