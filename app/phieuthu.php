<?php

namespace App;
use App\khachhang;
use Illuminate\Database\Eloquent\Model;

class phieuthu extends Model
{
    public    $timestamps   = false;  
    protected $table        = 'phieuthu'; 
    protected $primaryKey   = 'pt_id';

    public function khachhang(){
        return $this->hasMany('App\khachhang', 'kh_id', 'kh_id');
    }
}
