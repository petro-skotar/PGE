<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediatekaDetails extends Model
{
    use HasFactory;
    
    protected $table = 'mediateka_details';
    
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
        return $this->belongsTo('App\Models\Mediateka', 'mediateka_id');
    }
    
}
