<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReestrAML extends Model
{
    use HasFactory;
	
    protected $table = 'reestr_aml';
    
    protected $guarded = [];
	
	public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
	
	public function organization_aml($aml_artile_id)
    {
		return 'App\Models\Article'::where('id', $aml_artile_id)->first();
    }
    
	# Получение кода файла
	public function code()
    {
		if(!empty($this->filename)){
			$temp = explode('/',$this->filename);
			$code = explode('.',$temp[2]);
			return $code[0];
		} else {
			return '';
		}
    }
}