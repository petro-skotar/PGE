<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Setting;
use Config;

class DATA extends Controller
{
	# Версия сайта | также сбрасывает кеш css-стилей и js-скриптов
	public $version = '1.01';

	# Информация о сайте
	static function home(){
		$article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang', DATA::lang())
			->where('articles_details.name', '!=', '')
			//->where('articles_details.url','/')
			->where('active','1')
			->where('template','main')
			->first();

		if(!empty($article)){
			return $article;
		}
		return (object)[];
	}

	# Конкретная страница
	static function pageId($id){
		$article = Article::where('id',$id)
			->where('active','1')
			->first();

		if(!empty($article)){
			return $article;
		}
		return false;
	}

	# Приоритетнй язык
	static function priority_lang(){
		$setting = Setting::where('code','priority_lang')->first();
		if(!empty($setting)){
			return $setting->val;
		}
		return 'pl';
	}

	# Настройки Все
	static function setting($code = '*'){
		if($code == '*'){
			$setting = Setting::get()->keyBy('code');
			return $setting;
		} else {
			$setting = Setting::where('code',$code)->first();
			return $setting->val;
		}
	}

	# Определяем модуль
	static function module(){
		$uri_array = explode('/',request()->path());
		if (!empty($uri_array[1])){
			return $uri_array[1];
		} else {
			return false;
		}
	}

	# Определяем язык
	static function lang(){
		# через локаль
		return str_replace('_', '-', app()->getLocale());
		# статично через настройки
		//$aliases = Config::get('cms.sites.'.DATA::mode().'.alias');
		//return $aliases[DATA::domen()]['lang'];
	}

	# Определяем сайт по языку
	/*public function site_lang($lang){
		$aliases = config('cms.sites.'.DATA::mode().'.alias');
		foreach($aliases as $alias=>$details){
			if($details['lang'] == $lang){
				return $alias;
				break;
			}
		}
		return '';
	}*/

	# Определяем среду
	static function mode(){
		if(in_array(request()->getHost(), ['localhost','127.0.0.1'])){
			return 'local';
		}
		$d = explode('.',request()->getHost());
		if($d[1]=='loc'){
			return 'local';
		}
		return 'production';
	}

	# Статусы заявок на регистрацию на мероприятие
	public const UserStatus = [
		-1 => 'Отклонена',
		0 => 'Не обработана',
		1 => 'Подтверждена',
	];

	# Категории в FAQ
	public const faqCategories = [
		0 => 'Na stronie głównej',
		1 => 'Wybór partnera – dlaczego FASTEP Fulfillment?',
		2 => 'Realizacja usług',
	];


	# Определяем домен
	static function domen(){
		if(in_array(request()->getHost(), ['localhost','127.0.0.1'])){
			return 'checkhyip.loc';
		}
		return request()->getHost();
	}

	# Вывод данных в шаблоны
	public function compose($view)
    {
        # Текущая версия сайта
        $view->with('VERSION', $this->version);

        # Информация о сайте
        $view->with('HOME', $this->home());

        # Текущая среда locac или prod // Это нужно будет удалить
        $view->with('MODE', $this->mode());

        # Текущий модуль
		$view->with('MODULE', $this->module());

        # Текущий язык
		$view->with('LANG', $this->lang());

        # Приоритетный язык
		$view->with('PRIORITY_LANG', $this->priority_lang());

        # Настройки
		$view->with('SETTING', $this->setting());
    }
}
