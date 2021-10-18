<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use HasFactory;
    public $guarded = [];

    public function employment(){
        return $this->belongsTo(UserEmploymentInfo::class, 'user_employment_info_id', 'id');
    }

    public function modules(){
        return $this->belongsTo(UserModule::class, 'user_module_id', 'id');
    }
         
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function info(){
        return $this->belongsTo(UserInfo::class, 'user_info_id', 'id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
