<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Database\Eloquent\SoftDeletes;

class admin extends Authenticatable implements JWtSubject
{
    use SoftDeletes;

    public $table = 'admins';

    protected $hidden = ['passwords']; //ẩn hiển thị mật khẩu khi lấy thông tin 

    public function getPasswordAttribute()

    {

      return $this->passwords;

    }

    public function getJWTIdentifier()

    {

       return $this->getKey();

    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
