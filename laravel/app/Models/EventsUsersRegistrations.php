<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsUsersRegistrations extends Model
{
    use HasFactory;
    
    protected $table = 'events_users_registrations';
	
    protected $guarded = [];
	
	public function details_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }
	
	public function details_event()
    {
        return $this->belongsTo('App\Models\Article', 'event_id','id');
    }
	
	public function details_events()
    {
        return $this->belongsTo('App\Models\ArticlesDetails', 'event_id','article_id')->where('lang',app()->getLocale());
    }
	
	public function details_role()
    {
        return $this->belongsTo('App\Models\EventsRoles', 'event_role_id','id');
    }
    
	public function details_sections_reg()
    {
        return $this->hasMany('App\Models\EventsSectionsRegistrations', 'event_id', 'event_id');
    }
}
