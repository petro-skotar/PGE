<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use App\Models\Lang;
use App\Models\Setting;

use App\Models\Article;

use Illuminate\Support\Facades\Validator;
use DateTime;
use Config;
use Hash;


class ManagersController extends Controller
{	

	# Определяем тип пользователя
	protected function user_module(Request $request){		
		if($request->is('admin/uchastniki-aml/users-aml'.'*')){
			$user_module = 'users-aml';
		} elseif($request->is('admin/uchastniki-pfr/users-pfr'.'*')){
			$user_module = 'users-pfr';
		} elseif($request->is('admin/users'.'*')){
			$user_module = 'users';
		} elseif($request->is('admin/config/managers'.'*')){
			$user_module = 'admin';
		} elseif($request->is('admin/dublicates-users'.'*')){
			$user_module = 'dublicates';
		} else {
			$user_module = false;
		}		
		return $user_module;
	}
	
	# Определяем среду
	protected function mode(){
		$d = explode('.',request()->getHost());
		if($d[1]=='loc'){
			$mode = 'loc';
		} else {
			$mode = 'prod';			
		}
		return $mode;		
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if ($this->user_module($request) == 'admin') {			
			$table_search = '';
			if(isset($request->table_search_submit) && !empty($request->table_search)){
				$table_search = $request->table_search;
			}
			$managers = User::where('role','admin')->where('role_id','<>',8)->where('role_id','<>',6)->where(function($query) use ($table_search)
			{
				// Если поиск по пользователям
				if(!empty($table_search)){
					$query->orWhere('name', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('surname', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('patronymic', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('email', 'ILIKE', '%' . $table_search . '%');
				}

			})->orderBy('id')->get();							
			$roles = Roles::orderBy('id')->get();
			return view('admin/managers/managers')->with([
				'managers'=>$managers,
				'roles'=>$roles,
				'table_search'=>$table_search,
			]);			
		} elseif ($this->user_module($request) == 'users-aml') {
			$table_search = '';
			if(isset($request->table_search_submit) && !empty($request->table_search)){
				$table_search = $request->table_search;
			}
			$managers = User::where('role','admin')->where('role_id',8)->where(function($query) use ($table_search)
			{
				// Если поиск по пользователям
				if(!empty($table_search)){
					$query->orWhere('name', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('surname', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('patronymic', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('email', 'ILIKE', '%' . $table_search . '%');
				}

			})->orderBy('id')->get();							
			$roles = Roles::orderBy('id')->get();							
			return view('admin/users-aml/users')->with([
				'managers'=>$managers,
				'roles'=>$roles,
				'table_search'=>$table_search,
			]);			
		} elseif ($this->user_module($request) == 'users-pfr') {
			$table_search = '';
			if(isset($request->table_search_submit) && !empty($request->table_search)){
				$table_search = $request->table_search;
			}
			$managers = User::where('role','admin')->where('role_id',6)->where(function($query) use ($table_search)
			{
				// Если поиск по пользователям
				if(!empty($table_search)){
					$query->orWhere('name', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('surname', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('patronymic', 'ILIKE', '%' . $table_search . '%');
					$query->orWhere('email', 'ILIKE', '%' . $table_search . '%');
				}

			})->orderBy('id')->get();							
			$roles = Roles::orderBy('id')->get();							
			return view('admin/users-pfr/users')->with([
				'managers'=>$managers,
				'roles'=>$roles,
				'table_search'=>$table_search,
			]);			
		} elseif ($this->user_module($request) == 'users') {
			$table_search = '';
			if(isset($request->table_search_submit) && !empty($request->table_search)){
				$table_search = $request->table_search;
			}
			$managers = User::where('role','user')->where(function($query) use ($table_search){
					// Если поиск по пользователям
					if(!empty($table_search)){
						$query->orWhere('name', 'ILIKE', '%' . $table_search . '%');
						$query->orWhere('surname', 'ILIKE', '%' . $table_search . '%');
						$query->orWhere('patronymic', 'ILIKE', '%' . $table_search . '%');
						$query->orWhere('email', 'ILIKE', '%' . $table_search . '%');
					}

				})->orderBy('send_verify_registration','asc')
			->orderBy('created_at','desc')->paginate(15);
			
			$count_dublicates = \DB::select("select * from users ou
				where (select count(*) from users inr
					where 	inr.email = ou.email 
						and (  (inr.role = 'user' and ou.role = 'user') 
							OR (inr.role = 'user' and ou.role = 'admin' and ou.role_id = 8) 
							OR (inr.role = 'admin' and inr.role_id = 8 and ou.role = 'user') 
							OR (inr.role = 'admin' and ou.role = 'admin' and inr.role_id = 8)) 
						and ou.active = 1  
						and inr.active = 1) > 1
			order by email");

			$roles = Roles::orderBy('id')->get();
			return view('admin/users/users')->with([
				'managers'=>$managers,
				'roles'=>$roles,
				'table_search'=>$table_search,
				'count_dublicates'=>$count_dublicates,
			]);
			
		} elseif ($this->user_module($request) == 'dublicates') {
			
			$userData = \DB::select("select * from users ou
				where (select count(*) from users inr
					where 	inr.email = ou.email 
						and (  (inr.role = 'user' and ou.role = 'user') 
							OR (inr.role = 'user' and ou.role = 'admin' and ou.role_id = 8) 
							OR (inr.role = 'admin' and inr.role_id = 8 and ou.role = 'user') 
							OR (inr.role = 'admin' and ou.role = 'admin' and inr.role_id = 8)) 
						and ou.active = 1  
						and inr.active = 1) > 1
			order by email");
			$managers = User::hydrate($userData);
			//dd($managers);
			
			$roles = Roles::orderBy('id')->get();
			return view('admin.users.dublicates-users')->with([
				'managers'=>$managers,
				'roles'=>$roles,
				'table_search'=>'',
				'dublicates'=>'dublicates',
			]);
			
		}
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {		
		$manager = new User;		
		$roles = Roles::orderBy('id')->get();
		// Нужен список Организаций МСИ
		
		if ($this->user_module($request) == 'admin') {
			return view('admin/managers/manager')->with([
				'manager'=>$manager,
				'roles'=>$roles,
			]);
		} elseif ($this->user_module($request) == 'users-aml') {
			$orderBy_field = 'position';
			$orderBy_sort = 'asc';
			$organizations = Article::where('module','uchastniki-aml')->orderBy($orderBy_field,$orderBy_sort)->get();
			return view('admin/users-aml/user')->with([
				'manager'=>$manager,
				'roles'=>$roles,
				'organizations'=>$organizations,
			]);
		} elseif ($this->user_module($request) == 'users-pfr') {
			$orderBy_field = 'position';
			$orderBy_sort = 'asc';
			$organizations = Article::where('module','uchastniki-pfr')->orderBy($orderBy_field,$orderBy_sort)->get();
			return view('admin/users-pfr/user')->with([
				'manager'=>$manager,
				'roles'=>$roles,
				'organizations'=>$organizations,
			]);
		} elseif ($this->user_module($request) == 'users') {
			return view('admin/users/user')->with([
				'manager'=>$manager,
				'roles'=>$roles,
			]);
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if ($this->user_module($request) == 'admin') { #admin
			$this->validate($request,[
				'name' => 'required',
				'email' => 'required|email',
				'password' => 'required|min:8',
			]);
		} elseif ($this->user_module($request) == 'users-aml') {
			$validator = Validator::make(request()->all(), [
				'name' => 'required',
				'email' => 'required|email',
				'password' => 'required|min:8',
			]);
			$validator->after(function ($validator) {
				if($u = User::where('email', request('email'))->first()){
					$validator->errors()
						->add('twin_email', 'Пользователь с таким email уже существует.');
				}
			});			
			$validator->validate();
			
		} elseif ($this->user_module($request) == 'users-pfr') {
			$this->validate($request,[
				'name' => 'required',
				'email' => 'required|email',
				'password' => 'required|min:8',
			]);
		} elseif ($this->user_module($request) == 'users') { #user
			/*$request->validate([
				'name' => 'required',
				'post' => 'required',
				'email' => 'required|email',
				'password' => 'required|min:8',
			]);*/
			
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
			});			
			$validator->validate();

		}
		
        $manager = User::create([
		    'name' => $request->name,
		    'email' => $request->email,
		    'password' => Hash::make($request->password),
		]);	
		if ($this->user_module($request) == 'admin') { #admin
			$manager->role 	= 'admin';
			$manager->active = ($request->active ? $request->active : 0);
			$manager->role_id 	= ($request->role_id ? $request->role_id : 0);
		} elseif ($this->user_module($request) == 'users') { #user
			$manager->role 	= 'user';
			$manager->active = 1;
			$manager->role_id 	= ($request->role_id ? $request->role_id : 0);
		}

		$manager->send_verify_registration 	= 1;
		
		$manager->surname 	= ($request->surname ? $request->surname : '');
		
		$manager->patronymic 	= ($request->patronymic ? $request->patronymic : '');
		
		$manager->phone 	= ($request->phone ? $request->phone : '');

		$manager->post 	= ($request->post ? $request->post : '');
		
		$manager->city 	= ($request->city ? $request->city : '');
		
		$manager->comments 	= ($request->comments ? $request->comments : '');
		
		$manager->birthday 	= ($request->birthday ? new DateTime($request->birthday) : null);
		
	    $manager->save();
		
		if(!empty($request->send_to_email)){
			$feedback = (object) array(
				'email' => $manager->email,					
				'password' => $request->password,					
			);
			$subject = 'Регистрация на сайте '.Config::get('cms.sites.'.$this->mode().'.site_name');
			app('App\Http\Controllers\SendMailsController')->send_mailer(
				$manager->email,
				$feedback,
				$subject, 
				'user_create'
			);
		}
		
		if ($this->user_module($request) == 'admin') {
			return redirect()->route('managers.index');
		} elseif ($this->user_module($request) == 'users-aml') {
			return redirect()->route('users-aml.index');
		} elseif ($this->user_module($request) == 'users-pfr') {
			return redirect()->route('users-pfr.index');
		} elseif ($this->user_module($request) == 'users') {
			return redirect()->route('users.index');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {        
        
		if ($this->user_module($request) == 'admin') {
			$manager = User::find($id);        
			$roles = Roles::orderBy('id')->get();
			return view('admin/managers/manager')->with([
				'manager'=>$manager,		
				'roles'=>$roles,		
			]);
		} elseif ($this->user_module($request) == 'users') {
			$manager = User::find($id);        
			return view('admin/users/user')->with([
				'manager'=>$manager,		
			]);			
		}
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
			
			# active
			if(isset($request->active)){
				$manager = User::find($id);  
				if($manager->id == 1){
					$manager->active 	= 1;
				} else {
					$manager->active 		= ($request->active ? $request->active : 0);
				}
				$manager->save();
				return "ajax_update_active";
			}
			
			# auto_verify
			if(isset($request->auto_verify)){
				$manager = User::find($id);  
				$manager->active 	= 1;
				$manager->send_verify_registration 	= 1;
				# Отправляем пользователю письмо о подтверждении регистрации на сайте
				$feedback = (object) array(
					'email' => $manager->email,					
				);
				$subject = 'Подтверждение регистрации на сайте '.Config::get('cms.sites.'.$this->mode().'.site_name');
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$manager->email,
					$feedback,
					$subject, 
					'user_registrations_on_site_confirm'
				);
				$manager->save();
				
				return "ajax_update_auto_verify";
			}
			
			return false;
			
		} else { #Обычное сохранение
			
			# Определяем, админ это, или обычны пользователь (users)
			if ($this->user_module($request) == 'admin') {
				$manager = User::find($id);
				if($manager->id != 1){
					$manager->role_id 	= ($request->role_id ? $request->role_id : 0);
				}
			} elseif ($this->user_module($request) == 'users') { #user
				$manager = User::find($id);
				$manager->role_id 	= ($request->role_id ? $request->role_id : 0);
			}
			
			if(!empty($request->password)){
				$this->validate($request,[
					'name' => 'required',
					'email' => 'required|email',
					'password' => 'required|min:8',
				]);
				
				$manager->password 	= Hash::make($request->password);
				
			}elseif(isset($request->email)){
				$this->validate($request,[
					'name' => 'required',
					'email' => 'required|email',
				]);
			}
			
			if($manager->id == 1){
				$manager->active 	= 1;
			} else {
				$manager->active 	= ($request->active ? $request->active : 0);
			}
			$manager->name 		= ($request->name ? $request->name : '');
			$manager->email 	= $request->email;
			
			
			$manager->surname 	= ($request->surname ? $request->surname : '');
			
			$manager->patronymic 	= ($request->patronymic ? $request->patronymic : '');
			
			$manager->phone 	= ($request->phone ? $request->phone : '');

			$manager->post 	= ($request->post ? $request->post : '');
			
			$manager->city 	= ($request->city ? $request->city : '');
			
			$manager->comments 	= ($request->comments ? $request->comments : '');
			
			$manager->birthday 	= ($request->birthday ? new DateTime($request->birthday) : null);
			
			$user_registrations_on_site_confirm_send = '';
			
			# Подтверждаем регистрацию
			if(isset($request->send_verify_registration)){
				$manager->send_verify_registration 	= 1;
				$manager->active = 1;					
				# Отправляем пользователю письмо о подтверждении регистрации на сайте
				$feedback = (object) array(
					'email' => $manager->email,					
				);
				$subject = 'Подтверждение регистрации на сайте '.Config::get('cms.sites.'.$this->mode().'.site_name');
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$manager->email,
					$feedback,
					$subject, 
					'user_registrations_on_site_confirm'
				);
				$user_registrations_on_site_confirm_send = 'Письмо о подтверждении выслано пользователю на почту.';
			}
			# Отклоняем регистрацию
			if(isset($request->send_verify_registration_off)){
				$manager->send_verify_registration 	= 1;
				# Отправляем пользователю письмо о НЕ подтверждении регистрации на сайте
				$feedback = (object) array(
					'email' => $manager->email,					
				);
				$subject = 'Вам отказано в регистрации на сайте '.Config::get('cms.sites.'.$this->mode().'.site_name');
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$manager->email,
					$feedback,
					$subject, 
					'user_registrations_on_site_confirm_no'
				);
				$user_registrations_on_site_confirm_send = 'Письмо о неподтверждении выслано пользователю на почту.';
			}
			
			$user_create_new_password_send_result = '';
			if(!empty($request->password) && isset($request->create_password_and_send_to_user)){
				# Создаем новый пароль в админке и отправляем его пользователю
				$feedback = (object) array(
					'email' => $manager->email,					
					'password' => $request->password,					
				);
				$subject = 'Новый пароль для входа на сайт '.Config::get('cms.sites.'.$this->mode().'.site_name');
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$manager->email,
					$feedback,
					$subject, 
					'user_create_new_password'
				);
				$user_create_new_password_send_result = 'Пароль успешно выслан пользователю на почту.';
			}
						
			$manager->save();
			
				
			$roles = Roles::orderBy('id')->get();
			
			$messages_save = 'Данные сохранены.';			
			
			if ($this->user_module($request) == 'admin') {
				return redirect()->route('managers.edit',$id)
					->with('messages_save',$messages_save);
			} elseif ($this->user_module($request) == 'users-aml') {
				return redirect()->route('users-aml.edit',$id)
					->with('messages_save',$messages_save);
			} elseif ($this->user_module($request) == 'users-pfr') {
				return redirect()->route('users-pfr.edit',$id)
					->with('messages_save',$messages_save);
			} elseif ($this->user_module($request) == 'users') {
				return redirect()->route('users.edit',$id)
					->with('messages_save',$messages_save)
					->with('user_create_new_password_send_result',$user_create_new_password_send_result)
					->with('user_registrations_on_site_confirm_send',$user_registrations_on_site_confirm_send);
			}
			
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::where('id', $id)->delete();
        
		if ($this->user_module($request) == 'admin') {
			return redirect()->route('managers.index');
		} elseif ($this->user_module($request) == 'users-aml') {
			return redirect()->route('users-aml.index');
		} elseif ($this->user_module($request) == 'users-pfr') {
			return redirect()->route('users-pfr.index');
		} elseif ($this->user_module($request) == 'users') {
			return redirect()->route('users.index');
		} elseif ($this->user_module($request) == 'dublicates') {
			return redirect()->route('dublicates-users.index');
		}		
    }
   
}
