<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisions extends Model
{
    use HasFactory;
    
    protected $table = 'revisions';
    
    public $timestamps = false;
        
    protected $guarded = [];
	
	public function min_val($field)
    {
        return Revisions::selectRaw("MIN($field) AS val")
			->where('module','mediateka')
			->first();
    }
	
	public function document()
    {
        return $this->hasOne('App\Models\Mediateka', 'id', 'parent_id')->first();
    }
	
	public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')->first();
    }
    
	public function views($filter)
    {
        return $this->hasMany('App\Models\Revisions', 'parent_id', 'parent_id')
			->where('module','mediateka')
			->where('type_visit','v')
			->where(function($query) use ($filter){
				$query->where([
					['created_at', '>=', $filter['date_start']],
					['created_at', '<=', $filter['date_end'].' 23:59:59'],
				]);
			})
			->orderBy('created_at','asc')
			->get();
    }
    
	public function downloads($filter)
    {
        return $this->hasMany('App\Models\Revisions', 'parent_id', 'parent_id')
			->where('module','mediateka')
			->where('type_visit','d')
			->where(function($query) use ($filter){
				$query->where([
					['created_at', '>=', $filter['date_start']],
					['created_at', '<=', $filter['date_end'].' 23:59:59'],
				]);
			})
			->orderBy('created_at','asc')
			->get();
    }
	
}
