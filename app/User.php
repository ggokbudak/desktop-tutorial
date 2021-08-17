<?php

namespace App;

use App\Models\Roles;
use App\Models\BelediyeUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    protected $fillable = [
        'name', 'email', 'password','pic', 'roles', 'active'
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
        'active' => 'boolean',
        'roles' => 'int',
        
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roleData()
	{
		return $this->belongsTo(Roles::class, 'roles');
	}
    
    public function belediyeProfil()
	{
		return $this->HasManyThrough(\App\Models\BelediyeProfil::class, \App\Models\BelediyeUser::class, 'user_id', 'id', 'id', 'belediye_id');
	}

    public function firmaProfil()
	{
		return $this->HasManyThrough(\App\Models\LfirmaProfil::class, \App\Models\LfirmaUser::class, 'user_id', 'id', 'id', 'firma_id');
	}
    public function ureticiProfil()
	{
		return $this->HasManyThrough(\App\Models\UreticiProfil::class, \App\Models\UreticiUser::class, 'user_id', 'id', 'id', 'uretici_id');
	}
}
