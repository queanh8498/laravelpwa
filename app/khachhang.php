<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khachhang extends Model
{
    public    $timestamps   = false; //created_at

    protected $table        = 'khachhang';
    protected $fillable     = ['kh_ten', 'kh_diachi', 'kh_sdt'];
    protected $guarded      = ['kh_id'];

    protected $primaryKey   = 'kh_id';

    
    public function dondathang(){
        return $this->hasMany('App\dondathang', 'kh_id', 'kh_id');
    }
    
}
