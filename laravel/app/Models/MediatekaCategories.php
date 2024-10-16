<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MediatekaCategories extends Model
{
    use HasFactory;
    
    protected $table = 'mediateka_categories';
    
    public $timestamps = false;
    
    protected $guarded = [];
    
    /*protected $fillable = [
		'article_id', 
		'lang', 
		'title', 
		'name', 
		'description', 
		'bread',
		'annotation',
		'content',
		'short_name',
	];*/
	
	public function mediateka()
    {
        return $this->belongsTo('App\Models\Mediateka', 'id');
    }
	
	public function parent_category()
    {
        $category = $this->hasOne('App\Models\MediatekaCategories', 'id', 'parent_id')->first();
		if(!empty($category)){
			return $category;
		}
		return false;
    }
    
	public function documents()
    {
        if(Auth::user()->id != 1){ # Если это не главный администратор, а локальный
			return $this->hasMany('App\Models\Mediateka', 'category_id', 'id');										
		} else {
			return $this->hasMany('App\Models\Mediateka', 'category_id', 'id');
		}
    }
}
