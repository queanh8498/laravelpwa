<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phieuchi extends Model
{
    public    $timestamps   = false;

    protected $table        = 'phieuchi';
    protected $fillable     = ['pc_ngaylap','pc_lydochi', 'pc_tienchi'];
    protected $guarded      = ['pc_id'];
    protected $primaryKey   = 'pc_id';

    protected $dates        = ['pc_ngaylap'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function phieunhapkho(){
        return $this->hasMany('App\phieunhapkho', 'pc_id', 'pc_id');
    }

}
