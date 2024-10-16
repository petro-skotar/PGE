<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsSections extends Model
{
    use HasFactory;
    
    protected $table = 'events_sections';
	
    protected $guarded = [];
    
    public $timestamps = false;
}
