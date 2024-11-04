<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArticlesDetails;
use App\Models\User;
use App\Models\Setting;
use App\Models\Comments;
use App\Exports\PartnersExport;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Jobs\SendEmail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use SplFileInfo;
use Imagick;
use DateTime;
use Config;
use View;
use DB;
use Hash;

class ArticlesController extends Controller
{

	protected $comments_config = [
		0 => '<u>Не доступен</u> для комментирования/голосования',
		1 => 'Доступен для комментирования/голосования <u>только зарегистрированным</u> пользователям',
		# 2 => 'Доступен для комментирования/голосования <u>всем</u> пользователям',
	];

	protected $employmenttypes = [
		'FULL_TIME' => 'FULL_TIME',
		'PART_TIME' => 'PART_TIME',
		'CONTRACTOR' => 'CONTRACTOR',
		'TEMPORARY' => 'TEMPORARY',
		'INTERN' => 'INTERN',
		'VOLUNTEER' => 'VOLUNTEER',
		'PER_DIEM' => 'PER_DIEM',
		'OTHER' => 'OTHER',
	];

	# Узнаем последний ID в БД
	public function lid(){
		if (Auth::check()){
			$max = \DB::table('articles')->max('id');
			return 'articles: '.$max;
		} else {
			abort(404);
		}
	}

	public function compose($view)
    {
		$NAV_PAGES = array();

		$start_page = Article::where('id',1)->first();
		if(!empty($start_page)){
			$temp_PAGES = Article::where('parent_id',$start_page->id)->whereIn('module',['articles'])->where('in_nav','1')->where('active','1')->orderBy('position')->get();
			if(count($temp_PAGES)>0){
				foreach($temp_PAGES as $p_lv_0){
					if(!empty($p_lv_0->details_one['name'])){
						$NAV_PAGES[$p_lv_0->id]['url'] = $p_lv_0->details_one['url'];
						$NAV_PAGES[$p_lv_0->id]['name'] = $p_lv_0->details_one['name'];
						$NAV_PAGES[$p_lv_0->id]['filepath'] = $p_lv_0->filepath;
						$NAV_PAGES[$p_lv_0->id]['in_nav'] = $p_lv_0->in_nav;
						$NAV_PAGES[$p_lv_0->id]['module'] = $p_lv_0->module;
						$NAV_PAGES[$p_lv_0->id]['created_at'] = $p_lv_0->created_at;
						$NAV_PAGES[$p_lv_0->id]['template'] = $p_lv_0->template;
						$NAV_PAGES[$p_lv_0->id]['short_name'] = $p_lv_0->details_one['short_name'];

						$start_page_sub_lv_1 = Article::where('parent_id',$p_lv_0->id)->whereIn('module',['articles'])->where('active','1')->orderBy('position')->get();

						if(count($start_page_sub_lv_1)>0){
							foreach($start_page_sub_lv_1 as $p_lv_1){
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['url'] = $p_lv_1->details_one['url'];;
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['name'] = $p_lv_1->details_one['name'];
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['filepath'] = $p_lv_1->filepath;
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['in_nav'] = $p_lv_1->in_nav;
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['module'] = $p_lv_1->module;
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['created_at'] = $p_lv_1->created_at;
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['template'] = $p_lv_1->template;
								$NAV_PAGES[$p_lv_0->id]['sub'][$p_lv_1->id]['short_name'] = $p_lv_1->details_one['short_name'];
							}
						}

					}
				}
			}
		}

        $view->with('NAV_PAGES', $NAV_PAGES);
    }

	/**
     * Вывод записей в админке
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		# Это нужно повестить на каждый модуль
		if(!Auth::user()->roles_open_modules(Auth::user()->role_id, DATA::module())){
			return redirect('/admin/'.Auth::user()->roles_modules[0]['module']);
		}

		if(in_array(DATA::module(),['blog'])){
			$articles = Article::where('module',DATA::module())->orderBy('created_at','desc')->get();
		} elseif(in_array(DATA::module(),['faq'])){
			$articles = Article::where('module',DATA::module())->orderBy('faq_category','asc')->orderBy('position','asc')->get();
		} elseif(in_array(DATA::module(),['sections'])){
			$articles = Article::where('module',DATA::module())->orderBy('position','asc')->get();
		} else {
			$articles = Article::where('module',DATA::module())->orderBy('position','asc')->get();
		}
		return view('admin/articles/articles')->with([
			'articles'=>$articles,
			'module_info'=>Config::get('cms.modules.'.DATA::module()),
		]);

    }

	# Блог
    public function getBlog($count = 1000, $ignore_id = 0){
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles.id','!=',$ignore_id)
			->where('module','blog')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('created_at','desc')
			->limit($count)
			->get();
	}
    public function blog()
    {
		$articles = $this->getBlog();

		$article = Article::where('template','blog')->where('active',1)->first();
		if(!empty($article->details_one['name'])){

			$sections = [];
			foreach(config('cms.modules.sections.categories') as $key=>$section){
				if(in_array('blog',$section['templates']) || $section['templates'][0] == '*'){
					$sections[$key] = Article::getArticle($key);
				}
			}

			return view('templates.blog.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
				'sections'=>$sections,
			]);
		} else {
			abort(404);
		}
    }
    public function blogItem($url)
    {
		$article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles_details.url',$url)
			->where('active','1')
			->where('module','blog')
			->first();

		if(!empty($article->details_one->name)){

			$articles = $this->getBlog(4, $article->id);
			/*$faq = Article::where('template','faq')->where('active',1)->first();
			$faqs = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module',$faq->template)
				->where('faq_categories',$article->id)
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')
				->get();*/


			$sections = [];
			foreach(config('cms.modules.sections.categories') as $key=>$section){
				if(in_array($article->module,$section['templates']) || $section['templates'][0] == '*'){
					$sections[$key] = Article::getArticle($key);
				}
			}

			return view('templates.blog.id')->with([
				'article'=>$article,
				'articles'=>$articles,
				'sections'=>$sections,
				//'faqs'=>$faqs,
				//'faq'=>$faq,
			]);
		} else {
			abort(404);
		}
    }

	# Предложения на сайте
    public function getOffers(){
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','offers')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();
	}
    public function offers()
    {
		$articles = $this->getOffers();

		$article = Article::where('template','offers')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.offers.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }
    public function offer($url)
    {
		$Article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles_details.url',$url)
			->where('active','1')
			->where('module','offers')
			->first();

		if(!empty($Article->details_one->name)){

			$faq = Article::where('template','faq')->where('active',1)->first();
			$faqs = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module',$faq->template)
				->where('faq_categories',$Article->id)
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')
				->get();

			return view('templates.offers.id')->with([
				'article'=>$Article,
				'faqs'=>$faqs,
				'faq'=>$faq,
			]);
		} else {
			abort(404);
		}
    }

	# Комманда на сайте
    public function getTeams(){
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','team')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();
	}
    public function team()
    {
		$articles = $this->getTeams();
		$article = Article::where('template','team')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.team.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }

	# Services
    public function getServices(){
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','services')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();
	}
    public function services()
    {
		$articles = $this->getOffers();
		$article = Article::where('template','services')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.services.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }
    public function service()
    {
		$articles = $this->getServices();
		$article = Article::where('template','services')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.services.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }

	# Поекты на сайте
    public function getProjects(){
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','projects')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();
	}
    public function projects()
    {
		$articles = $this->getProjects();
		$article = Article::where('template','projects')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.projects.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }
    public function project($url)
    {
		$article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles_details.url',$url)
			->where('active','1')
			->where('module','projects')
			->first();

        $projects = Article::select('articles.*')
            ->leftJoin('articles_details', function($leftJoin){
                $leftJoin->on('articles.id', '=', 'articles_details.article_id');
            })
            ->where('articles.id', '!=', $article->id)
            ->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','projects')
			->where('parent_id',0)
			->where('active','1')
			->inRandomOrder()
            ->limit(6)->get();

		if(!empty($article->details_one->name)){
			/*$faq = Article::where('template','faq')->where('active',1)->first();
			$faqs = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module',$faq->template)
				->where('faq_categories',$article->id)
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')
				->get();*/

			return view('templates.projects.id')->with([
				'article'=>$article,
				'projects'=>$projects,
				//'faqs'=>$faqs,
				//'faq'=>$faq,
			]);
		} else {
			abort(404);
		}
    }

	# Отрасли на сайте
    public function getIndustries(){
		return Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','industries')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();
	}
    public function industries()
    {
		$articles = $this->getIndustries();

		$article = Article::where('template','industries')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.industries.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }
    public function industry($url)
    {
		$Article = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('articles_details.url',$url)
			->where('active','1')
			->where('module','industries')
			->first();

		if(!empty($Article->details_one->name)){

			$faq = Article::where('template','faq')->where('active',1)->first();
			$faqs = Article::select('articles.*')
				->leftJoin('articles_details', function($leftJoin){
						$leftJoin->on('articles.id', '=', 'articles_details.article_id');
					})
				->where('articles_details.lang',DATA::lang())
				->where('articles_details.name', '!=', '')
				->where('module',$faq->template)
				->where('faq_categories',$Article->id)
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')
				->get();

			return view('templates.industries.id')->with([
				'article'=>$Article,
				'faqs'=>$faqs,
				'faq'=>$faq,
			]);
		} else {
			abort(404);
		}
    }

	# Карьера на сайте
    public function career()
    {
		$articles = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','career')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();

		$article = Article::where('template','career')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.career.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }

	# Наша компания на сайте
    public function our_teams()
    {
		$articles = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','team')
			->where('parent_id',0)
			->where('active','1')
			->orderBy('position','asc')->get();

		$article = Article::where('template','team')->where('active',1)->first();
		if(!empty($article->details_one['name'])){
			return view('templates.team.listing')->with([
				'articles'=>$articles,
				'article'=>$article,
			]);
		} else {
			abort(404);
		}
    }

	# FAQ
    public function faq()
    {
		$articles = Article::select('articles.*')
			->leftJoin('articles_details', function($leftJoin){
					$leftJoin->on('articles.id', '=', 'articles_details.article_id');
				})
			->where('articles_details.lang',DATA::lang())
			->where('articles_details.name', '!=', '')
			->where('module','faq')
			->where('active','1')
			->orderBy('position','asc')
			->get();

		$article = Article::where('template','faq')->where('active',1)->first();
		if(!empty($article->details_one['name'])){

			$sections = [];
			foreach(config('cms.modules.sections.categories') as $key=>$section){
				if(in_array($article->template,$section['templates']) || $section['templates'][0] == '*'){
					$sections[$key] = Article::getArticle($key);
				}
			}

			return view('templates.faq')->with([
				'articles'=>$articles,
				'article'=>$article,
				'sections'=>$sections,
			]);
		} else {
			abort(404);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$Article = new Article;

		$parent_article = false;
		if(!empty($_GET['parent_id'])){
			$parent_article = Article::find($_GET['parent_id']);
		}

		$Article_details = array();

		foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details){
			$Article_details[$lang] = new ArticlesDetails;
		}

		$offers = array();
		$industries = array();
		if(DATA::module() == 'faq'){
			$offers = Article::where('module','offers')
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')->get();

			$industries = Article::where('module','industries')
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')->get();
		}
		return view('admin.articles.article')->with([
			'Article'=>$Article,
			'Article_details'=>$Article_details,
			'module_info'=>Config::get('cms.modules.'.DATA::module()),
			'parent_article'=>$parent_article,
			'comments_config'=>$this->comments_config,
			'offers'=>$offers,
			'industries'=>$industries,
			'employmenttypes'=>$this->employmenttypes,
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request,[
			'filepath' => 'max:102400|image',
			'logopath' => 'max:204800|image',
		]);

		/*if(Route::currentRouteName() == 'career.store'){
			$this->validate($request,[
				'employmenttype' => 'required',
			]);
		}*/

        $Article = Article::create([
		    'active' => ($request->active ? $request->active : 0),
		    'parent_id' => $request->parent_id,
		    'template' => ($request->template ? $request->template : 'article'),
		]);
	    $Article->position = ($request->position ? (int)$request->position : $Article->id);
	    $Article->module = DATA::module();

		if($request->hasFile('files')) {
			$files = [];
			foreach($request->file('files') as $image){
				//$files[] = $image->store(DATA::module(),'public');
				Storage::disk('public')->put(DATA::module().'/'.$image->getClientOriginalName(), file_get_contents($image));
				$files[] = DATA::module().'/'.$image->getClientOriginalName();
			}
			$Article->files = $files;
		}

		if($request->hasFile('images')) {
			$images = [];
			foreach($request->file('images') as $image){
				$images[] = $image->store(DATA::module(),'public');
			}
			$Article->images = $images;
		}

		if($request->hasFile('filepath')) {
			$Article->filepath = $request->file('filepath')->store(DATA::module(),'public');
			$info = new SplFileInfo('/storage/'.$Article->filepath);
		}

		if($request->hasFile('logopath')) {
			$Article->logopath = $request->file('logopath')->store(DATA::module(),'public');
			$info = new SplFileInfo('/storage/'.$Article->logopath);
		}

		if(isset($request->sub_template)){
			$Article->sub_template 	= $request->sub_template;
		}

		if(isset($request->created_at)){
			$Article->created_at 	= $request->created_at;
		}

		$Article->in_nav 	= ($request->in_nav ? $request->in_nav : 0);

		$Article->faq_category 	= ($request->faq_category ? $request->faq_category : 0);

		$Article->faq_categories 	= ($request->faq_categories ? $request->faq_categories : 1);

		$Article->employmenttype 	= ($request->employmenttype ? json_encode($request->employmenttype) : '');

		if(isset($request->sub)){
			$Article->sub 	= $request->sub;
		}

		if(isset($request->open_comments)){
			$Article->open_comments 	= $request->open_comments;
		}

	    $Article->save();

		foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details){
			if(!empty($request->details[$lang]['name'])){

                $this->validate($request,[
                    'details.'.$lang.'.file' => 'mimes:pdf',
                ]);

				$Article_details[$lang] = new ArticlesDetails;
				$Article_details[$lang]->article_id = $Article->id;
				$Article_details[$lang]->lang = $lang;
				$Article_details[$lang]->name = $request->details[$lang]['name'];
				$Article_details[$lang]->url = 			(!empty($request->details[$lang]['url']) ? $request->details[$lang]['url'] : '');
				$Article_details[$lang]->title = 		(!empty($request->details[$lang]['title']) ? $request->details[$lang]['title'] : '');
				$Article_details[$lang]->short_name = 	(!empty($request->details[$lang]['short_name']) ? $request->details[$lang]['short_name'] : '');
				$Article_details[$lang]->bread = 		(!empty($request->details[$lang]['bread']) ? $request->details[$lang]['bread'] : '');
				$Article_details[$lang]->description = 	(!empty($request->details[$lang]['description']) ? $request->details[$lang]['description'] : '');
				$Article_details[$lang]->annotation = 	(!empty($request->details[$lang]['annotation']) ? $request->details[$lang]['annotation'] : '');
				$Article_details[$lang]->slogan = 		(!empty($request->details[$lang]['slogan']) ? $request->details[$lang]['slogan'] : '');
				$Article_details[$lang]->content = 		(!empty($request->details[$lang]['content']) ? $request->details[$lang]['content'] : '');
				$Article_details[$lang]->content_2 = 	(!empty($request->details[$lang]['content_2']) ? $request->details[$lang]['content_2'] : '');
				$Article_details[$lang]->content_3 = 	(!empty($request->details[$lang]['content_3']) ? $request->details[$lang]['content_3'] : '');
				$Article_details[$lang]->client = 	    (!empty($request->details[$lang]['client']) ? $request->details[$lang]['client'] : '');
				$Article_details[$lang]->location = 	(!empty($request->details[$lang]['location']) ? $request->details[$lang]['location'] : '');
				$Article_details[$lang]->start_date = 	(!empty($request->details[$lang]['start_date']) ? $request->details[$lang]['start_date'] : '');
				$Article_details[$lang]->end_date = 	(!empty($request->details[$lang]['end_date']) ? $request->details[$lang]['end_date'] : '');
                if($request->hasFile('details.'.$lang.'.file')) {
                    $file = $request->file('details.'.$lang.'.file');
                    $file_name = DATA::module().'/'.$Article->id.'/'.$file->getClientOriginalName();
                    Storage::disk('public')->put($file_name, file_get_contents($file));
                    $Article_details[$lang]->file = $file_name;
                }
				$Article_details[$lang]->save();
			}
		}

	    return redirect()->route(DATA::module().'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route(DATA::module().'.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array(Auth::user()->role_id, [8])){ # Участник МСИ
			if(Auth::user()->aml_artile_id != $id){
				return redirect()->route('uchastniki-aml.edit', Auth::user()->aml_artile_id);
			}
			if(empty(Auth::user()->aml_artile_id)){
				Auth::logout();
				return redirect()->route('login');
			}
		} elseif(in_array(Auth::user()->role_id, [6])){ # Сотрудник ПФР
			if(Auth::user()->pfr_artile_id != $id){
				return redirect()->route('uchastniki-pfr.edit', Auth::user()->pfr_artile_id);
			}
			if(empty(Auth::user()->pfr_artile_id)){
				Auth::logout();
				return redirect()->route('login');
			}
		}

		$date_errors = array();
		$Article = Article::find($id);
        if(!$Article){
			return redirect()->route('Admin404');
		}
		$details_table = $Article->details_many;
		$Article_details = array();
		foreach ($details_table as $detail){
			$Article_details[$detail->lang] = $detail;
		}
		foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details){
			if(empty($Article_details[$lang])){
				$Article_details[$lang] = new ArticlesDetails;
				$Article_details[$lang]->lang = $lang;
			}
		}


		$offers = array();
		$industries = array();
		if(DATA::module() == 'faq'){
			$offers = Article::where('module','offers')
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')->get();

			$industries = Article::where('module','industries')
				->where('parent_id',0)
				->where('active','1')
				->orderBy('position','asc')->get();
		}

		return view('admin/articles/article')->with([
			'Article'=>$Article,
			'Article_details'=>$Article_details,
			'module_info'=>Config::get('cms.modules.'.DATA::module()),
			'date_errors'=>$date_errors,
			'comments_config'=>$this->comments_config,
			'offers'=>$offers,
			'industries'=>$industries,
			'employmenttypes'=>$this->employmenttypes,
		]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	if(isset($request->update_type)){ # сохранение по ajax

			if(isset($request->active)){
				$Article = Article::find($id);
				$Article->active = ($request->active ? $request->active : 0);
				$Article->save();
				return "ajax_update_active";
			}

			return false;

		} else { #Обычное сохранение

			if(in_array(Auth::user()->role_id, [8]) && Auth::user()->aml_artile_id != $id){ # Участник МСИ
				return redirect()->route('uchastniki-aml.edit', Auth::user()->aml_artile_id);
			} elseif(in_array(Auth::user()->role_id, [6]) && Auth::user()->pfr_artile_id != $id){ # Сотрудник ПФР
				return redirect()->route('uchastniki-pfr.edit', Auth::user()->pfr_artile_id);
			}

			$date_errors = array();

			$this->validate($request,[
				'filepath' => 'max:102400|image',
				'logopath' => 'max:204800|image',
			]);

			/*if(Route::currentRouteName() == 'career.update'){
				$this->validate($request,[
					'employmenttype' => 'required',
				]);
			}*/

			$Article = Article::find($id);

			$Article->active 	= ($request->active ? $request->active : 0);

			$Article->in_nav 	= ($request->in_nav ? $request->in_nav : 0);

			$Article->faq_category 	= ($request->faq_category ? $request->faq_category : 0);

			$Article->faq_categories 	= ($request->faq_categories ? $request->faq_categories : 1);

			$Article->employmenttype 	= ($request->employmenttype ? json_encode($request->employmenttype) : '');

			if(isset($request->tender_result)){
				$Article->tender_result 	= $request->tender_result;
			}

			$Article->position = ($request->position ? (int)$request->position : $Article->id);

			if(isset($request->created_at)){
				$Article->created_at 	= $request->created_at;
			}

			if(isset($request->template)){
				$Article->template 	= $request->template;
			}

			$Article->sub_template 	= ($request->sub_template ? $request->sub_template : '');

			if(!in_array($Article->module,['sections'])){
				$Article->sub 	= ($request->sub ? $request->sub : 'no');
			}

			$files = json_decode($Article->files, true);
			if(isset($request->files_remove) && !empty($files)){
				foreach($request->files_remove as $index=>$val){
					unset($files[$index]);
				}
				$files = array_values($files);
				$Article->files = $files;
			}
			if($request->hasFile('files')) {
				foreach($request->file('files') as $image){
					//$files[] = $image->store(DATA::module(),'public');
					Storage::disk('public')->put(DATA::module().'/'.$image->getClientOriginalName(), file_get_contents($image));
					$files[] = DATA::module().'/'.$image->getClientOriginalName();
				}
				$files = array_values($files);
			}
			$Article->files = $files;

			$images = json_decode($Article->images, true);
			if(isset($request->images_remove) && !empty($images)){
				foreach($request->images_remove as $index=>$val){
					unset($images[$index]);
				}
				$images = array_values($images);
				$Article->images = $images;
			}
			if($request->hasFile('images')) {
				foreach($request->file('images') as $image){
					$images[] = $image->store(DATA::module(),'public');
				}
				$images = array_values($images);
			}
			$Article->images = $images;

			if(isset($request->filepath_remove)){
				$Article->filepath = '';
			}elseif($request->hasFile('filepath')) {
				$Article->filepath = $request->file('filepath')->store(DATA::module(),'public');
				$info = new SplFileInfo('/storage/'.$Article->filepath);
			}

			if(isset($request->logopath_remove)){
				$Article->logopath = '';
			}elseif($request->hasFile('logopath')) {
				$Article->logopath = $request->file('logopath')->store(DATA::module(),'public');
				$info = new SplFileInfo('/storage/'.$Article->logopath);
			}

			if(isset($request->open_comments)){
				$Article->open_comments 	= $request->open_comments;
			}

			$Article->save();

			$date_errors = '';

			if(!empty($request->details)){

				foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details){

					if(!empty($request->details[$lang]['name'])){
						if(!empty($request->details[$lang]['id'])){
							$Article_details[$lang] = ArticlesDetails::find($request->details[$lang]['id']);
						} else {
							$Article_details[$lang] = new ArticlesDetails;
						}

                        $this->validate($request,[
                            'details.'.$lang.'.file' => 'mimes:pdf',
                        ]);

						$Article_details[$lang]->article_id = $id;
						$Article_details[$lang]->lang = $lang;
						$Article_details[$lang]->name = $request->details[$lang]['name'];
						$Article_details[$lang]->url = 			(!empty($request->details[$lang]['url']) ? $request->details[$lang]['url'] : '');
						$Article_details[$lang]->title = 		(!empty($request->details[$lang]['title']) ? $request->details[$lang]['title'] : '');
						$Article_details[$lang]->short_name = 	(!empty($request->details[$lang]['short_name']) ? $request->details[$lang]['short_name'] : '');
						$Article_details[$lang]->bread = 		(!empty($request->details[$lang]['bread']) ? $request->details[$lang]['bread'] : '');
						$Article_details[$lang]->description = 	(!empty($request->details[$lang]['description']) ? $request->details[$lang]['description'] : '');
						$Article_details[$lang]->annotation = 	(!empty($request->details[$lang]['annotation']) ? $request->details[$lang]['annotation'] : '');
						$Article_details[$lang]->slogan = 		(!empty($request->details[$lang]['slogan']) ? $request->details[$lang]['slogan'] : '');
						$Article_details[$lang]->content = 		(!empty($request->details[$lang]['content']) ? $request->details[$lang]['content'] : '');
						$Article_details[$lang]->content_2 = 	(!empty($request->details[$lang]['content_2']) ? $request->details[$lang]['content_2'] : '');
						$Article_details[$lang]->content_3 = 	(!empty($request->details[$lang]['content_3']) ? $request->details[$lang]['content_3'] : '');
                        $Article_details[$lang]->client = 	    (!empty($request->details[$lang]['client']) ? $request->details[$lang]['client'] : '');
                        $Article_details[$lang]->location = 	(!empty($request->details[$lang]['location']) ? $request->details[$lang]['location'] : '');
                        $Article_details[$lang]->start_date = 	(!empty($request->details[$lang]['start_date']) ? $request->details[$lang]['start_date'] : '');
                        $Article_details[$lang]->end_date = 	(!empty($request->details[$lang]['end_date']) ? $request->details[$lang]['end_date'] : '');
                        if(!empty($request->details[$lang]['file_remove'])) {
                            $Article_details[$lang]->file = '';
                        }
                        if($request->hasFile('details.'.$lang.'.file')) {
                            $file = $request->file('details.'.$lang.'.file');
                            $file_name = DATA::module().'/'.$Article->id.'/'.$file->getClientOriginalName();
                            Storage::disk('public')->put($file_name, file_get_contents($file));
                            $Article_details[$lang]->file = $file_name;
                        }
						$Article_details[$lang]->save();
					} else {
						if(!empty($request->details[$lang]['id'])){
							ArticlesDetails::find($request->details[$lang]['id'])->delete();
						}
					}

				}

			}

			/*if(in_array($Article->module,['articles'])){
				$messages_save = 'Страница успешно сохранена. <a href="/'.$Article->url.'" target="_blank">Посмотреть</a>';
			} else {
				$messages_save = 'Страница успешно сохранена. <a href="/'.$Article->module.'/'.$Article->url.'" target="_blank">Посмотреть</a>';
			}*/
			$messages_save = 'Страница успешно сохранена.';
			return redirect()->route(DATA::module().'.edit',$id)
				->with('messages_save',$messages_save)
				->with('date_errors',$date_errors);

		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        ArticlesDetails::where('article_id', '=', $id)->delete();
        Article::where('id', $id)->delete();

        return redirect()->route(DATA::module().'.index');
    }

}
