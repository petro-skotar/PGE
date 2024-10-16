<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsRoles extends Model
{
    use HasFactory;
    
    protected $table = 'events_roles';
	
    protected $guarded = [];
    
    public $timestamps = false;
}
