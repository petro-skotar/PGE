<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediatekaRoles extends Model
{
    use HasFactory;
    
    protected $table = 'mediateka_roles';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function mediateka()
    {
        return $this->belongsTo('App\Models\Mediateka', 'mediateka_id');
    }
    
}
