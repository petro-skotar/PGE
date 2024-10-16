<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetailsNapravlenia extends Model
{
    use HasFactory;
    
    protected $table = 'articles_details_napravlenia';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function details()
    {
        return $this->belongsTo('App\Models\ArticlesDetails', 'details_id');
    }
    
	public function programs()
    {
        return $this->hasMany('App\Models\ArticleDetailsNapravleniaPrograms', 'napravlenia_id')->orderBy('id');
    }
}
