<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\ShortcodeController;

class ArticlesDetails extends Model
{
    use HasFactory;

    protected $table = 'articles_details';

    public $timestamps = false;

    protected $guarded = [];

	public function article()
    {
        return $this->belongsTo('App\Models\Article', 'article_id')
			->where('active', 1);
    }

	public function napravlenia_list()
    {
        return $this->hasMany('App\Models\ArticleDetailsNapravlenia', 'details_id')->orderBy('id');
    }

	public function izdania_list()
    {
        return $this->hasMany('App\Models\ArticleDetailsIzdaniya', 'details_id')->orderBy('id');
    }

	public function prepodavatelipodft_list()
    {
        return $this->hasMany('App\Models\ArticleDetailsPrepodavatelipodft', 'details_id')->orderBy('id');
    }

	public function content_modify()
    {
		if(!empty($this->content)){

			# чистка от лишнего кода
			$content = preg_replace("/&#?[a-z0-9]{2,8};/i"," ",$this->content);
			$content = str_replace("&#8203;", "", $content);
			$content = str_replace("&ZeroWidthSpace;", "", $content);
			$content = str_replace("\xE2\x80\x8C", "", $content);
			$content = preg_replace( '/[\x{200B}-\x{200D}]/u', "", $content );

			# шорткоды видео
			$n=1;
			while($n){
				$out=0;
				preg_match("|\[video-(.+?)\]|is", $content, $out);
				if (!empty($out[1])){
					$id = str_replace("#", '', $out[1]);
					$html_shortcode = ShortcodeController::shortcode('video',$id);
					if(!empty($html_shortcode)){
						$content = str_replace("<p>[video-".$out[1]."]</p>", $html_shortcode, $content);
						$content = str_replace("[video-".$out[1]."]", $html_shortcode, $content);
					}
					$content = str_replace("[video-".$out[1]."]", '', $content);
				} else {
					$n=0;
					break;
				}
			}

			# шорткоды Настроек
			$html_shortcode = ShortcodeController::shortcode('setting','policy_file');
			if(!empty($html_shortcode)){
				$content = str_replace("<p>[setting-policy_file]</p>", $html_shortcode, $content);
				$content = str_replace("[setting-policy_file]", $html_shortcode, $content);
			}
			$content = str_replace("[setting-policy_file]", '', $content);

			return $content;
		}
		return '';
    }

	# Хештеги
	public function hashtags()
    {
		if(!empty($this->hashtag)){
			$hashtags = explode(',', $this->hashtag);
			return $hashtags;
		}
		return [];
    }

}
