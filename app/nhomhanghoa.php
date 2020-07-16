<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhomhanghoa extends Model
{
    const     CREATED_AT    = 'nhom_ngaytaomoi';
    const     UPDATED_AT    = 'nhom_ngaycapnhat';
    
    protected $table        = 'nhomhanghoa';
    protected $fillable     = ['nhom_ten', 'ncc_id','nhom_ngaytaomoi','nhom_ngaycapnhat'];

    protected $guarded      = ['nhom_id'];
    protected $primaryKey   = 'nhom_id';

    public function hanghoa(){
        return $this->hasMany('App\hanghoa', 'nhom_id', 'nhom_id');
    }
    public function nhacungcap(){
        return $this->belongsTo('App\nhacungcap', 'ncc_id', 'ncc_id');
    }
}
