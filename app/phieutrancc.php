<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieutrancc extends Model
{
    public    $timestamps   = false;

    protected $table        = 'phieutrancc';
    protected $fillable     = ['pnk_id', 'ncc_id','id','ptncc_ngaylap','ptncc_trangthai'];
    protected $guarded      = ['ptncc_id'];
    protected $primaryKey   = 'ptncc_id';
   
    protected $dates        = ['ptncc_ngaylap'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function phieunhapkho(){
        return $this->belongsTo('App\phieunhapkho', 'pnk_id', 'pnk_id');
    }
   public function nhacungcap(){
        return $this->belongsTo('App\nhacungcap', 'ncc_id', 'ncc_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'id', 'id');
    }

}
