<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\ArticlesDetails;

use App\Models\Mediateka;
use App\Models\MediatekaCategories;
use App\Models\MediatekaRoles;
use App\Models\Lang;
use App\Models\Setting;

use App\Models\VisuallyImpaireds;

use Carbon\Carbon;
use Config;

class IndexController extends Controller
{

    public function index()
    {

		$article = Article::where('template','main')->where('active',1)->first();
		if(!empty($article)){

			$projects = app(ArticlesController::class)->getProjects();
			$teams = app(ArticlesController::class)->getTeams();
			/*
			$faq = Article::where('template','faq')->where('active',1)->first();
			$faqs = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module','faq')
				->where('faq_category',0)
				->where('active','1')
				->orderBy('position','asc')
				->get();

			$reviews = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module','reviews')
				->where('active','1')
				->orderBy('position','asc')
				->get();
			$benefits = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module','benefits')
				->where('active','1')
				->orderBy('position','asc')
				->get();*/

			$sections = [];
			foreach(config('cms.modules.sections.categories') as $key=>$section){
				if(in_array($article->template,$section['templates']) || $section['templates'][0] == '*'){
					$sections[$key] = Article::getArticle($key);
				}
			}

        	return view('templates.main.main')->with([
	        	'article'=>$article,
	        	'projects'=>$projects,
	        	'teams'=>$teams,
	        	/*'offers'=>$offers,
	        	'offer'=>$offer,
	        	'faqs'=>$faqs,
	        	'faq'=>$faq,
	        	'reviews'=>$reviews,*/
	        	//'benefits'=>$benefits,
	        	'sections'=>$sections,
	        ]);
		} else {
			abort('404');
		}

    }

    public function page($url)
    {
		$ArticlesDetails = ArticlesDetails::where('lang',DATA::lang())
			->where('name', '!=', '')
			->where('url', $url)
			->first();

		if(!empty($ArticlesDetails)){

			$article = $ArticlesDetails->article()->first();
			/*$reviews = false;
			if(in_array($article->template,['about_history'])){
				$reviews = Article::select('articles.*')
					->leftJoin('articles_details', function($leftJoin){
							$leftJoin->on('articles.id', '=', 'articles_details.article_id');
						})
					->where('articles_details.lang',DATA::lang())
					->where('articles_details.name', '!=', '')
					->where('module','reviews')
					->where('active','1')
					->orderBy('position','asc')
					->get();
			}*/

			if(in_array($article->module,['offers','industries','blog','projects'])){
				return redirect($article->getModule()->details_one()->first()->url.'/'.$url);
			}

			if(in_array($article->template,['projects']) && in_array($article->module,['articles'])){
				return redirect($article->details_one->url.'/'.Article::firstChild('projects')->details_one->url);
			}

			$sections = [];
			foreach(config('cms.modules.sections.categories') as $key=>$section){
				if(in_array($article->template,$section['templates']) || $section['templates'][0] == '*'){
					$sections[$key] = Article::getArticle($key);
				}
			}

			if($article->sub != 'nav'){
				return view('templates.'.$article->template)->with([
					'article'=>$article,
					'sections'=>$sections,
				]);
			} else {
				if($article->template == 'offers'){
					return app('App\Http\Controllers\ArticlesController')->offers();
				}
				if($article->template == 'projects'){
					return app('App\Http\Controllers\ArticlesController')->projects();
				}
				if($article->template == 'industries'){
					return app('App\Http\Controllers\ArticlesController')->industries();
				}
				if($article->template == 'career'){
					return app('App\Http\Controllers\ArticlesController')->career();
				}
				if($article->template == 'team'){
					return app('App\Http\Controllers\ArticlesController')->our_teams();
				}
				if($article->template == 'blog'){
					return app('App\Http\Controllers\ArticlesController')->blog();
				}
			}
		} else {
			abort('404');
		}
    }

    public function module_page($url,$url2)
    {

		$ArticlesDetails = ArticlesDetails::where('lang',DATA::lang())
			->where('name', '!=', '')
			->where('url', $url)
			->first();
		if(!empty($ArticlesDetails)){

			$article = $ArticlesDetails->article()->first();

			if($article->template == 'offers'){
				return app('App\Http\Controllers\ArticlesController')->offer($url2);
			}
			if($article->template == 'industries'){
				return app('App\Http\Controllers\ArticlesController')->industry($url2);
			}
			if($article->template == 'blog'){
				return app('App\Http\Controllers\ArticlesController')->blog($url2);
			}
			if($article->template == 'projects'){
				return app('App\Http\Controllers\ArticlesController')->project($url2);
			}
			abort(404);
		} else {
			abort(404);
		}
    }
}
