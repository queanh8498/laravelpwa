<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiettrancc extends Model
{
    public    $timestamps   = false;

    protected $table        = 'chitiettrancc';
    protected $fillable     = ['ctncc_soluong', 'ctncc_dongia'];
    protected $guarded      = ['ptncc_id', 'hh_id'];

    protected $primaryKey   = ['ptncc_id', 'hh_id'];
   

    public function hanghoa(){
        return $this->belongsTo('App\hanghoa', 'hh_id', 'hh_id');
    }
    public function phieutrancc(){
        return $this->belongsTo('App\phieutrancc', 'ptncc_id', 'ptncc_id');
    }
}
