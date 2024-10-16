<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediateka extends Model
{
    use HasFactory;
    
    protected $table = 'mediateka';
    
    public $timestamps = true;
    
    protected $guarded = [];
    
    /*protected $fillable = [
		'parend_id', 
		'position', 
		'created', 
		'url', 
		'active', 
		'template',
	];*/
	
	public function details_one()
    {
        return $this->hasOne('App\Models\MediatekaDetails', 'mediateka_id');
    }
    
	public function details_many()
    {
        return $this->hasMany('App\Models\MediatekaDetails', 'mediateka_id')->orderBy('lang','desc');
    }
	
	public function favorites($user_id)
    {
        return $this->hasMany('App\Models\MediatekaFavorites', 'mediateka_id');
    }
    
	# Получение кода файла
	public function code()
    {
        if(!empty($this->filepath)){
			$temp = explode('/',$this->filepath);
			$code = explode('.',$temp[1]);
			return $code[0];
		} else {
			return '';
		}
    }
    
	# Получение кода превьюшки
	public function preview_code()
    {
        if(!empty($this->filepreview)){
			$temp = explode('/',$this->filepreview);
			$code = explode('.',$temp[2]);
			if(!empty($code[2])){
				# Учитываем auto_preview_1233454.2345.jpg
				return $code[0].'.'.$code[1];
			} else {
				return $code[0];
			}
		} else {
			return '';
		}
    }
    
	public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'page_id')->where('module','mediateka')->orderBy('created_at')->get();
    }
    
	public function category()
    {
        return $this->belongsTo('App\Models\MediatekaCategories', 'category_id')->first();
    }
    
	public function revisions_count($type_visit, $filter = [])
    {
        return $this->hasMany('App\Models\Revisions', 'parent_id')
			->where('module','mediateka')
			->where('type_visit',$type_visit)
			->where(function ($query) use (
								$filter
							) {
							# Избранное
							if(!empty($filter)){
								$query->where([
									['created_at', '>=', $filter['date_start']],
									['created_at', '<=', $filter['date_end'].' 23:59:59'],
								]);
							}
						})
			->count();
    }
	
	public function event_connect($id)
    {
        return Article::where('docs_event_id', $id)
			->where('module','events')
			->first();
    }
}
