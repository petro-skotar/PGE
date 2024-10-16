<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetailsNapravleniaProgramsFiles extends Model
{
    use HasFactory;
    
    protected $table = 'articles_details_napravlenia_programs_files';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function programs()
    {
        return $this->belongsTo('App\Models\ArticleDetailsNapravleniaPrograms', 'program_id');
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
