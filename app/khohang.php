<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khohang extends Model
{
    public $timestamps = false;
    
    protected $table        = 'khohang';
    protected $fillable     = ['kho_ten','kho_diachi'];

    protected $guarded      = ['kho_id'];
    protected $primaryKey   = 'kho_id';
   

    public function hanghoa(){
        return $this->hasMany('App\hanghoa', 'kho_id', 'kho_id');
    }
    public function phieunhapkho(){
        return $this->hasMany('App\phieunhapkho', 'kho_id', 'kho_id');
    }
    public function phieuxuatkho(){
        return $this->hasMany('App\phieuxuatkho', 'kho_id', 'kho_id');
    }
}
