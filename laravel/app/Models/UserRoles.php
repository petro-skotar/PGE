<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    use HasFactory;
    
    protected $table = 'users_roles';
    
    public $timestamps = false;
    
    protected $guarded = [];
    	
	public function user()
    {
        return $this->belongsTo('App\Models\User', user_id);
    }
}
