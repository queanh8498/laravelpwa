<?php

namespace App;
use App\khachhang;
use Illuminate\Database\Eloquent\Model;

class congno_khachhang extends Model
{
    public    $timestamps   = false;  
    protected $table        = 'congno_khachhang'; 
    protected $primaryKey   = 'cnkh_id';

    public function khachhang(){
        return $this->belongsTo('App\khachhang', 'kh_id', 'kh_id');
    }
}
