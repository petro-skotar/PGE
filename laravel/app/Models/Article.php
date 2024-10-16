<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    public $timestamps = false;

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
        return $this->hasOne('App\Models\ArticlesDetails', 'article_id')->where('lang',\DATA::lang())->where('name','!=','');
    }

	public function details_lang($lang)
    {
        return $this->hasOne('App\Models\ArticlesDetails', 'article_id')->where('lang',$lang)->first();
    }

	public function details_many()
    {
        return $this->hasMany('App\Models\ArticlesDetails', 'article_id')->orderBy('lang','desc');
    }

	public function getArticleFromUrl($url)
    {
		return Article::where('template',$url)->first();
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

	public function getPrevious(){
        return Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',\DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module', $this->module)
				->where('active','1')
				->where('position', '<', $this->position)->orderBy('position','desc')->first();
    }

	public function getNext(){
        return Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',\DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module', $this->module)
				->where('active','1')
				->where('position', '>', $this->position)->orderBy('position','asc')->first();
    }

    # Получение доп-шаблонов модуля
	public function getSubTemplates($module){
		$directory = '../laravel/resources/views/templates/'.$module.'/sub_template/';
		if (file_exists($directory)) {
			$scanned_directory = array_diff(scandir($directory), array('..', '.'));
			foreach($scanned_directory as $key=>$arr){
				$scanned_directory[$key] = str_replace ('.blade.php','',$scanned_directory[$key]);
			}
			return $scanned_directory;
		}
		return false;
	}

	public static function getArticle($id, $fields = 'articles.*'){
		return Article::select($fields)
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',\DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles.id',$id)
			->where('active','1')
			->first();
	}

	public function children()
	{
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',\DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('parent_id',$this->id)
			->where('module','sections')
			->where('active','1')
			->orderBy('position','asc')
			->get();
	}

	public function child($id)
	{
		$article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',\DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles.id',$id)
			->where('module','sections')
			->where('active','1')
			->orderBy('position','asc')
			->first();
		if($article) return $article;
		return false;
	}

    public static function firstChild($module)
    {
		$Article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',\DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles_details.url', '!=', '')
			->where('active','1')
			->where('module',$module)
			->orderBy('position','asc')
			->first();
		return $Article;
    }

	public function getModule()
    {
        return Article::where('template',$this->module)->first();
    }

	public function getParent($field = 'parent_id')
    {
        if($field == 'parent_id') return Article::find($this->parent_id);
        if($field == 'faq_categories') return Article::find($this->faq_categories);
		return false;
    }

	public function img($index = 0)
    {
		if(empty($this->images)){
			return '';
		}
		$images = json_decode($this->images, true);
        if($index === 'all'){
			$new_images = [];
			foreach($images as $image){
				$new_images[] = (File::exists($image) ? asset($image) : (File::exists('storage/'.$image) ? asset('storage/'.$image) : ''));
			}
			return $new_images;
		} else {
			if(empty($images[$index])){
				return '';
			}
			return (File::exists($images[$index]) ? asset($images[$index]) : (File::exists('storage/'.$images[$index]) ? asset('storage/'.$images[$index]) : ''));
		}
    }

	public function fls($index = 0)
    {
		if(empty($this->files)){
			return '';
		}
		$files = json_decode($this->files, true);
        if($index === 'all'){
			$new_images = [];
			foreach($files as $file){
				$new_images[] = (File::exists($file) ? asset($file) : (File::exists('storage/'.$file) ? asset('storage/'.$file) : ''));
			}
			return $new_images;
		} else {
			return (File::exists($files[$index]) ? asset($files[$index]) : (File::exists('storage/'.$files[$index]) ? asset('storage/'.$files[$index]) : ''));
		}
    }

}
