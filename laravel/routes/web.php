<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomAuthController;

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\RevisionsController;

use App\Http\Controllers\MultiFileUploadAjaxController;

use Smalot\PdfParser\Parser;
use App\Models\Mediateka;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Админ панель
Route::group(['middleware' => ['auth', 'isadmin'],'prefix'=>'admin'], function(){

	# Страницы
		Route::resource('articles',		'App\Http\Controllers\ArticlesController');

	# Блог
		Route::resource('blog',			'App\Http\Controllers\ArticlesController');
	# Предложения
		Route::resource('offers',		'App\Http\Controllers\ArticlesController');
	# Предложения
		Route::resource('projects',		'App\Http\Controllers\ArticlesController');
	# Отрасли
		Route::resource('industries',	'App\Http\Controllers\ArticlesController');
	# Карьера
		Route::resource('career',		'App\Http\Controllers\ArticlesController');
	# Наша команда
		Route::resource('team',		    'App\Http\Controllers\ArticlesController');
	# FAQ
		//Route::resource('faq',		'App\Http\Controllers\ArticlesController');
	# Отзывы
		Route::resource('reviews',		'App\Http\Controllers\ArticlesController');
	# Преимущества
		Route::resource('benefits',		'App\Http\Controllers\ArticlesController');
	# Секции
        Route::resource('sections',		'App\Http\Controllers\ArticlesController');
    # Подписка
        Route::resource('subscribe',	'App\Http\Controllers\SubscribeController');
        Route::get('subscribe-export',  'App\Http\Controllers\SubscribeController@export')->name('subscribe-export');

	# Пользователи сайта
		Route::resources(['users' => ManagersController::class]);

	# настройки
	  # Администраторы
		Route::resources(['config/managers' => ManagersController::class]);
	  # Роли
		Route::resources(['config/roles' => RolesController::class]);
	  # Settings
		Route::resources(['config/setting' => SettingController::class]);

	Route::get('404','App\Http\Controllers\Admin404Controller@index')->name('Admin404');

	# Последний ID в БД
	Route::get('lid', 					'App\Http\Controllers\ArticlesController@lid')->name('lid');

	Route::get('/',	function(){
		return redirect('/admin/articles');
	});

});

Route::group(['middleware' => ['auth', 'isadmin']], function(){

	# Загружчик файлов
		Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')->name('ckfinder_examples');
		Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
		Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');

});

Route::group(['prefix' => LaravelLocalization::setLocale(),	'middleware' => [ 'FullChecks', 'localizationRedirect', 'localeViewPath']], function(){
	//Route::group([], function(){

	# Ресайзинг картинок
		Route::get('img/{module}/{code}/{w}', 'App\Http\Controllers\ImgResizerController@getImg')->name('getImg');

	Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
	Route::post('/add_subscribe', 'App\Http\Controllers\SubscribeController@add_subscribe')->name('add_subscribe');
    Route::get('subscribe-check',   'App\Http\Controllers\SubscribeController@check')->name('subscribe-check');
    Route::get('unsubscribe',   'App\Http\Controllers\SubscribeController@unsubscribe')->name('unsubscribe');

	Route::get('/send-email', 'App\Http\Controllers\SendMailsController@registrations_on_site');
	Route::post('/forms', 'App\Http\Controllers\FormsController@forms')->name('forms');

	Route::get('login', [CustomAuthController::class, 'index'])->name('login');
	Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
	Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
	Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
	Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

	# Персональные данные
		Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
		Route::put('dashboard/{id}', [CustomAuthController::class, 'custom_update'])->name('dashboard_update');

	# Избранное
		Route::middleware(['auth:sanctum', 'verified'])->get('cabinet/favorites', [MediatekaController::class, 'listing'])->name('favorites');

	# Мои мероприятия (в кабинете)
		Route::middleware(['auth:sanctum', 'verified'])->get('cabinet/events', [ArticlesController::class, 'cabinet_events'])->name('cabinet_events');

	Route::get('/admin', function(){return redirect('/admin/articles');})->name('admin');
	Route::get('redirects', 'App\Http\Controllers\RedirectController@index');

	Route::get('d/{code}', 				'App\Http\Controllers\MediatekaController@download_files')->name('download_files');

	# Предложения
		Route::get('/blog/{url}', 			'App\Http\Controllers\ArticlesController@blogItem')->name('viewBlogItem');
		Route::get('/blog', 				'App\Http\Controllers\ArticlesController@blog')->name('viewBlog');
	# Предложения
		Route::get('/offers/{url}', 		'App\Http\Controllers\ArticlesController@offer')->name('viewOffer');
		Route::get('/offers', 				'App\Http\Controllers\ArticlesController@offers')->name('viewOffers');
    # Services
        Route::get('/services/{url}', 		'App\Http\Controllers\ArticlesController@service')->name('viewService');
        Route::get('/services', 			'App\Http\Controllers\ArticlesController@services')->name('viewServices');
	# Предложения
		Route::get('/projects/{url}', 		'App\Http\Controllers\ArticlesController@project')->name('viewProject');
		Route::get('/projects', 			'App\Http\Controllers\ArticlesController@projects')->name('viewProjects');
	# Карьера
		Route::get('/career', 				'App\Http\Controllers\ArticlesController@career')->name('viewCcareers');
	# Наша команда
		Route::get('/team/{url}', 			'App\Http\Controllers\ArticlesController@our_team')->name('viewOurTeam');
		Route::get('/team', 				'App\Http\Controllers\ArticlesController@our_teams')->name('viewOurTeams');
	# FAQ
		//Route::get('/faq', 				'App\Http\Controllers\ArticlesController@faq')->name('viewFAQ');

	# Загрузка картнок
		Route::get('multi-file-ajax-upload', [MultiFileUploadAjaxController::class, 'index']);
		Route::post('/store-multi-file-ajax', 'App\Http\Controllers\MultiFileUploadAjaxController@storeMultiFile');

	# СЕО
		Route::get('/sitemap.xml', 			'App\Http\Controllers\SEOController@sitemap');
		Route::get('/robots.txt', 			'App\Http\Controllers\SEOController@robots_txt');

	Route::get('/{url}/{url2}', 			'App\Http\Controllers\IndexController@module_page')->name('viewAsItemModules');
	Route::get('/{url}', 					'App\Http\Controllers\IndexController@page')->name('viewArticle');
});
