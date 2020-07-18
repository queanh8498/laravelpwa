<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class baocaotonkho extends Model
{
    public    $timestamps   = false;

    protected $table        = 'baocaotonkho';
    protected $fillable     = ['pxk_id', 'pnk_id'];
    protected $guarded      = ['bctk_id'];

    protected $primaryKey   = 'bctk_id';

    public function phieuxuatkho(){
        return $this->belongsTo('App\phieuxuatkho', 'pxk_id', 'pxk_id');
    }
    public function phieunhapkho(){
        return $this->belongsTo('App\phieunhapkho', 'pnk_id', 'pnk_id');
    }
}
