<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieuxuatkho extends Model
{
    public    $timestamps   = false;

    protected $table        = 'phieuxuatkho';
    protected $fillable     = ['id', 'kho_id','pxk_ngayxuatkho'];
    protected $guarded      = ['pxk_id'];
    protected $primaryKey   = 'pxk_id';

    protected $dates        = ['pxk_ngayxuatkho'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function khohang(){
        return $this->belongsTo('App\khohang', 'kho_id', 'kho_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'id', 'id');
    }
}
