<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hanghoa extends Model
{
    const     CREATED_AT    = 'hh_ngaytaomoi';
    const     UPDATED_AT    = 'hh_ngaycapnhat';

    protected $table        = 'hanghoa';
    protected $fillable     = ['hh_ten', 'hh_dongia', 'hh_hinh','hh_soluong','hh_thongtin','hh_ngaytaomoi','hh_ngaycapnhat','nhom_id','kho_id','bctk_id'];
    protected $guarded      = ['hh_id'];

    protected $primaryKey   = 'hh_id';
    
    protected $dates        = ['hh_ngaytaomoi', 'hh_ngaycapnhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
    
    public function nhomhanghoa(){
        return $this->belongsTo('App\nhomhanghoa', 'nhom_id', 'nhom_id');
    }
    public function khohang(){
        return $this->belongsTo('App\khohang', 'kho_id', 'kho_id');
    }
    public function baocaotonkho(){
        return $this->hasMany('App\baocaotonkho', 'bctk_id', 'bctk_id');
    }


    
}
