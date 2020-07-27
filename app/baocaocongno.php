<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class baocaocongno extends Model
{
    public    $timestamps   = false;

    protected $table        = 'baocaocongno';
    protected $fillable     = ['bccn_hanno', 'bccn_soducongno','kh_id'];
    protected $guarded      = ['bccn_id'];

    protected $primaryKey   = 'bccn_id';   

    protected $dates        = ['bccn_hanno'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function dondathang(){
        return $this->belongsTo('App\dondathang', 'ddh_id', 'ddh_id');
    }
}
