<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='nhanvien';
	   protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dondathang(){
        return $this->hasMany('App\dondathang', 'id', 'id');
    }
    public function phieuxuatkho(){
        return $this->hasMany('App\phieuxuatkho', 'id', 'id');
    }
    public function phieunhapkho(){
        return $this->hasMany('App\phieunhapkho', 'id', 'id');
    }
}
