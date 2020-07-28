<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieutrahang extends Model
{
    public    $timestamps   = false;

    protected $table        = 'phieutrahang';
    protected $fillable     = ['pth_ngaylap', 'pth_trangthai','ddh_id','id'];
    protected $guarded      = ['pth_id'];
    protected $primaryKey   = 'pth_id';

    protected $dates        = ['pth_ngaylap'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function dondathang(){
        return $this->belongsTo('App\dondathang', 'ddh_id', 'ddh_id');
    }
      public function user(){
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
