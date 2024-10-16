<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SplFileInfo;

class DocumentsAml extends Model
{
    use HasFactory;
    
    protected $table = 'documents_aml';
    
    protected $guarded = [];
    
	public function users()
    {
        return $this->hasMany('App\Models\DocumentsAmlUsers', 'document_id');
    }
	public function document_view_user($user_id)
    {
        return $this->hasOne('App\Models\DocumentsAmlViews', 'document_id')->where('user_id',$user_id);
    }
	public function document_view_users()
    {
        return $this->hasMany('App\Models\DocumentsAmlViews', 'document_id');
    }
	  
	public function file_icon()
    {
		if(!empty($this->filepath)){
			$file_info = explode('.', $this->filepath);
			$file_extension = end($file_info);
			return $file_extension;
		} else {
			return 'file';
		}
    }
    
	# Получение кода файла
	public function code()
    {
        if(!empty($this->filepath)){
			$temp = explode('/',$this->filepath);
			$code = explode('.',$temp[2]);
			return $code[0];
		} else {
			return '';
		}
    }
}
