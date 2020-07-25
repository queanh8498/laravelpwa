<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieunhapkho extends Model
{
    public    $timestamps   = false;

    protected $table        = 'phieunhapkho';
    protected $fillable     = ['id', 'kho_id','pnk_ngaynhapkho'];
    protected $guarded      = ['pnk_id'];
    protected $primaryKey   = 'pnk_id';
    public $incrementing = false;
    protected $dates        = ['pnk_ngaynhapkho'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function khohang(){
        return $this->belongsTo('App\khohang', 'kho_id', 'kho_id');
    }
   
    public function user(){
        return $this->belongsTo('App\User', 'id', 'id');
    }

}
