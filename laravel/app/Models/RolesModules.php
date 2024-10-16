<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModules extends Model
{
    use HasFactory;
    
    protected $table = 'roles_modules';
    
    public $timestamps = false;
    
    protected $guarded = [];
    	
	public function user()
    {
        return $this->belongsTo('App\Models\Roles', 'role_id');
    }
}
