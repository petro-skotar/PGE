<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetailsNapravleniaPrograms extends Model
{
    use HasFactory;
    
    protected $table = 'articles_details_napravlenia_programs';
    
    public $timestamps = false;
    
    protected $guarded = [];
	
	public function napravlenia()
    {
        return $this->belongsTo('App\Models\ArticleDetailsNapravlenia', 'napravlenia_id');
    }
    
	public function files()
    {
        return $this->hasMany('App\Models\ArticleDetailsNapravleniaProgramsFiles', 'program_id')->orderBy('id')->get();
    }
    
	# Получение кода файла
	public function code1()
    {
		if(!empty($this->file1)){
			$temp = explode('/',$this->file1);
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
	public function code2()
    {
        if(!empty($this->file2)){
			$temp = explode('/',$this->file2);
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
	public function code3()
    {
        if(!empty($this->file3)){
			$temp = explode('/',$this->file3);
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
