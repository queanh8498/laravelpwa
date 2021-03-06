<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dondathang extends Model
{
    public    $timestamps   = false;

    protected $table        = 'dondathang';
    protected $fillable     = ['kh_id','id', 'ddh_trangthai','ddh_ngaylap','ddh_giamchietkhau','ddh_congnocu','ddh_congnomoi','ddh_datra','pxk_id'];
    protected $guarded      = ['ddh_id'];
    protected $primaryKey   = 'ddh_id';

    protected $dates        = ['ddh_ngaylap'];
    protected $dateFormat   = 'Y-m-d H:i:s';
    
    public function khachhang(){
        return $this->belongsTo('App\khachhang', 'kh_id', 'kh_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'id', 'id');
    }
    public function baocaocongno(){
        return $this->belongsTo('App\baocaocongno', 'ddh_id', 'ddh_id');
    }
	 public function phieuxuatkho(){
        return $this->belongsTo('App\phieuxuatkho', 'pxk_id', 'pxk_id');
    }
}
