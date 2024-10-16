<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsSectionsRegistrations extends Model
{
    use HasFactory;
    
    protected $table = 'events_sections_registrations';
	
    protected $guarded = [];
}
