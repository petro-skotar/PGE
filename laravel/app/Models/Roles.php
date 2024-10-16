<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    
    protected $table = 'roles';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function roles_one()
    {
        return $this->hasOne('App\Models\RolesModules', 'role_id');
    }
    
	public function roles_many()
    {
        return $this->hasMany('App\Models\RolesModules', 'role_id');
    }
	
}
