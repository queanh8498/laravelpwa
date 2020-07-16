<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiettrahang extends Model
{
    public    $timestamps   = false;

    protected $table        = 'chitiettrahang';
    protected $fillable     = ['ctth_soluong', 'ctth_dongia'];
    protected $guarded      = ['pth_id', 'hh_id'];

    protected $primaryKey   = ['pth_id', 'hh_id'];
    public    $incrementing = false;

    public function hanghoa(){
        return $this->belongsTo('App\hanghoa', 'hh_id', 'hh_id');
    }
    public function phieutrahang(){
        return $this->belongsTo('App\phieutrahang', 'pth_id', 'pth_id');
    }
}
