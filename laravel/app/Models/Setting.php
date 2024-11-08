<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $table = 'setting';
	
    protected $guarded = [];
    
    public $timestamps = false;
    
	protected $casts = [
        'files' => 'array',
    ];
}
