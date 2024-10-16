<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediatekaFavorites extends Model
{
    use HasFactory;
    
    protected $table = 'mediateka_favorites';
	
    protected $guarded = [];
    
    public $timestamps = false;
	
	public function mediateka()
    {
        return $this->belongsTo('App\Models\Mediateka', 'mediateka_id');
    }
	
}
