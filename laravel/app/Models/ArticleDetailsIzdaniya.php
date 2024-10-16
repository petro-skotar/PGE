<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetailsIzdaniya extends Model
{
    use HasFactory;
    
    protected $table = 'articles_details_izdaniya';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function details()
    {
        return $this->belongsTo('App\Models\ArticlesDetails', 'details_id');
    }
	# Получение кода файла
	public function code()
    {
		if(!empty($this->filepath)){
			$temp = explode('/',$this->filepath);
			if(!empty($temp[2])){
				$code = explode('.',$temp[2]);
				return $code[0];
			} else {
				return '';
			}
		} else {
			return '';
		}
    }
}
