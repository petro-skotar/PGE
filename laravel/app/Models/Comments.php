<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    
    protected $table = 'comments';
	
    protected $guarded = [];
	
	public function article()
    {
        return $this->belongsTo('App\Models\Article', 'post_id')->first();
    }
	
	public function avatar()
    {
		if(!empty($this->name)){
			$words = explode(' ', $this->name);
			$avatar = mb_substr($words[0], 0, 1);
			if(!empty($words[1])){
				$avatar .= mb_substr($words[1], 0, 1);
			} else {
				$avatar .= mb_substr($words[0], 1, 1);
			}
			return mb_strtoupper($avatar);
		} else {
			return 'NN';
		}
    }
	
}
