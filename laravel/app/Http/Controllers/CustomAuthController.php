<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\PlaceOfWork;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Config;
use Lang;
use Hash;

class CustomAuthController extends Controller
{
	
	protected $file_types = array(
		'video' => array(
			'name' => array(
				'ru' => 'Видеоматериалы',
				'en' => 'Video',
			),
			'format' => array(
				'3gp',
				'mkv',
				'mp4',
				'm4v',
				'mov',
				'avi',
				'mpeg4',
				'webm',
			),
			'cont_on_page' => 6,
		),
		'document' => array(
			'name' => array(
				'ru' => 'Документы',
				'en' => 'Documents',
			),
			'format' => array(
				'jpg',
				'jpeg',
				'gif',
				'tif',
				'bmp',
				'ico',
				'png',
				
				'doc',
				'docx',
				'rtf',
				'xls',
				'xlsx',
			),
			'cont_on_page' => 14,
		),
		'book' => array(
			'name' => array(
				'ru' => 'Книги',
				'en' => 'Books',
			),
			'format' => array(
				'pdf',
			),
			'cont_on_page' => 9,
		),
		'course' => array(
			'name' => array(
				'ru' => 'Курсы',
				'en' => 'Courses',
			),
			'format' => array(
				'ppt',
				'pptx',
				'pps',
				'ppsx',
			),
			'cont_on_page' => 9,
		),
		'audio' => array(
			'name' => array(
				'ru' => 'Аудиоматериалы',
				'en' => 'Audio',
			),
			'format' => array(
				'flac',
				'ogg',
				'mp3',
			),
			'cont_on_page' => 9,
		),
		
	);
	
    public function index()
    {
		if(Auth::check()){
            return redirect("dashboard");
        }
		
		$article = new \App\Models\Article();
		$article->details_one = new \App\Models\ArticlesDetails();
		$article->details_one->title = __('messages.login_title');
		$article->details_one->description = __('messages.login_title');
		$article->images = '';
		$article->module = __('account');
		
		return view('templates.login')->with([
			'article'=>$article,
		]);
    }
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
		
		/*dd($request->all);
		if(isset($request->save_user_info)){
			dd('save_user_info');
		}*/
		
		// тут переделываем поиск пользователя в БД по домену
        $credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
		
		$user = User::where('email', $request->email)->where('active', 1)->first();
		
		if(!$user){ # пробуем зайти под главным админом
			$user = User::where('email', $request->email)->where('active', 1)->first();				
		}
	   
		if ($user && Hash::check($request->password, $user->password)) {
			Auth::login($user);
			return redirect("dashboard");
		} else {
			return redirect()->route('login')
					->with('date_errors',Lang::get('auth.failed'))
					->withInput();
		}

  
    }

    public function registration()
    {
		$article = new \App\Models\Article();
		$article->details_one = new \App\Models\ArticlesDetails();
		$article->details_one->title = __('messages.register');
		$article->details_one->description = __('messages.register');
		$article->images = '';
		$article->module = __('account');
		
		return view('templates.register')->with([
	        	'article'=>$article,
			]);
    }
      

    public function customRegistration(Request $request)
    {  
        $data = $request->all();
				
		# Добавляем свой типа валидатора
		$validator = Validator::make(request()->all(), [
			'name' => 'required',
			'post' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:8',
		]);
		$validator->after(function ($validator) {
			if($u = User::where('email', request('email'))->first()){
				$validator->errors()
					->add('twin_email', 'Пользователь с таким email уже существует.');
			}
			
			if (request('politica') == null) {
				$validator->errors()->add('politica', 'Вы должны согласить с политикой конфиденциальнсти.');
			}

		});			
		$validator->validate();
		
        $check = $this->create($data);
		
		# Отправляем пользователю на почту уведомление о регистрации на сайте
		$feedback = (object) array(
			'email' => $request->email,					
			'password' => $request->password,					
		);
		$subject = 'Регистрация на сайте '.Config::get('cms.sites.'.DATA::mode().'.site_name');
		app('App\Http\Controllers\SendMailsController')->send_mailer(
			$request->email,
			$feedback,
			$subject, 
			'user_registrations_on_site'
		);
		
		# Отправляем на почту админам уведомление о регистрации на сайте
		$feedback = (object) array(
			'name' => $request->name,					
			'surname' => $request->surname,					
			'patronymic' => $request->patronymic,					
			'phone' => $request->phone,					
			'name' => $request->name,					
			'email' => $request->email,					
			'password' => $request->password,					
		);
		$subject = 'Регистрация нового пользователя на сайте '.Config::get('cms.sites.'.DATA::mode().'.site_name');
		app('App\Http\Controllers\SendMailsController')->send_mailer(
			Setting::where('code','system_email')->first()->val,
			$feedback,
			$subject, 
			'for_admin.user_registrations_on_site'
		);
		
		// Авторизируем
		//$this->customLogin($request);
		
        return redirect("thank-you-for-registering-on-our-website");
    }


    public function create(array $data)
    {
      $birthday = new DateTime($data['birthday']);
	  
	  return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
		'surname' => $data['surname'],
		'patronymic' => $data['patronymic'],
		'phone' => $data['phone'],
		'post' => $data['post'],
		'city' => $data['city'],
		'birthday' => $birthday->format('Y-m-d H:i:s'),
		'comments' => $data['comments'],
		'active' => 0,		
		
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            
			if (Auth::user()->role == 'admin') {            
				return redirect('admin/articles');
			} elseif (Auth::user()->role == 'users-aml') {            
				return redirect('admin/uchastniki-aml');
			} elseif (Auth::user()->role == 'users-pfr') {            
				return redirect('admin/uchastniki-pfr');
			} else {
				
				$article = new \App\Models\Article();
				$article->details_one = new \App\Models\ArticlesDetails();
				$article->details_one->title = __('messages.acc_data').' - '.__('messages.personal_area');
				$article->details_one->description = __('messages.acc_data').' - '.__('messages.personal_area');
				$article->images = '';
				$article->module = __('account');
				
				return view('templates.dashboard')->with([
					'article'=>$article,
					'file_types'=>$this->file_types,
				]);
			}
        }
		
        return redirect("login")->withSuccess('You are not allowed to access');
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function custom_update(Request $request, $id)
    {    	    	    	
		$this->validate($request,[
			'name' => 'required',
			'surname' => 'required',
		]);
		
		$user = User::find($id); 
		
		$user->name = $request->name;
		$user->surname = $request->surname;
		$user->patronymic = $request->patronymic;
		$user->phone = $request->phone;
		$user->post = $request->post;
		$user->city = $request->city;
		$user->comments = $request->comments;
		$user->birthday = ($request->birthday ?  new DateTime($request->birthday) : null);
		
		$user->save();
		
		return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}