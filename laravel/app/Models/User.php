<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'surname',
        'patronymic',
        'phone',
        'post',
        'city',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
	
	protected $guarded = [];
	
	public function roles_one($id)
    {
        return 'App\Models\Roles'::where('id', $id)->first();
    }
	
	public function roles_modules()
    {
		return $this->hasMany('App\Models\RolesModules', 'role_id', 'role_id');
    }
	
	public function getFirstRolesModules($role_id)
    {
		return 'App\Models\RolesModules'::where('role_id', $role_id)->first();		
    }
	
	public function roles_open_modules($role_id, $module)
    {
		$c = 'App\Models\RolesModules'::where('role_id', $role_id)->where('module', $module)->first();
		if(!empty($c)){
			return true;
		} else {
			return false;			
		}
    }
    /*
	public function roles_many()
    {
        return $this->hasMany('App\Models\UserRoles', 'user_id');
    }*/
	
	public function organization_aml($aml_artile_id)
    {
		return 'App\Models\Article'::where('id', $aml_artile_id)->first();
    }
	
	public function organization_pfr($pfr_artile_id)
    {
		return 'App\Models\Article'::where('id', $pfr_artile_id)->first();
    }
	
	public function favorite($mediateka_id)
    {
        return 'App\Models\MediatekaFavorites'::where('mediateka_id', $mediateka_id)->where('user_id', $this->id)->first();
    }
	
	public function favorites()
    {
		return $this->hasMany('App\Models\MediatekaFavorites', 'user_id')->get();
    }
	
	public function events_registrations()
    {
		return $this->hasMany('App\Models\EventsUsersRegistrations', 'user_id')->orderBy('created_at', 'desc')->get();
    }
	
}
