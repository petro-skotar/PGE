<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsAmlUsers extends Model
{
    use HasFactory;
    
    protected $table = 'documents_aml_users';
    
    protected $guarded = [];
    
    public $timestamps = false;
	
	public function document()
    {
        return $this->belongsTo('App\Models\DocumentsAml', 'document_id');
    }
}
