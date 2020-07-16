<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietphieunhap extends Model
{
    public    $timestamps   = false;

    protected $table        = 'chitietphieunhap';
    protected $fillable     = ['ctpn_soluong', 'ctpn_dongia'];
    protected $guarded      = ['pnk_id', 'hh_id'];

    protected $primaryKey   = ['pnk_id', 'hh_id'];
    public    $incrementing = false;

    public function hanghoa(){
        return $this->belongsTo('App\hanghoa', 'hh_id', 'hh_id');
    }
    public function phieunhapkho(){
        return $this->belongsTo('App\phieunhapkho', 'pnk_id', 'pnk_id');
    }
}
