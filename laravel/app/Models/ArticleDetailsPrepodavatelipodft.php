<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetailsPrepodavatelipodft extends Model
{
    use HasFactory;
    
    protected $table = 'articles_details_prepodavatelipodft';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function details()
    {
        return $this->belongsTo('App\Models\ArticlesDetails', 'details_id');
    }
}
