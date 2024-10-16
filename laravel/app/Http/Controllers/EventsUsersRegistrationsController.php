<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use App\Models\ArticlesDetails;
use App\Models\Lang;
use App\Models\User;
use App\Models\EventsSections;
use App\Models\EventsType;
use App\Models\EventsRoles;
use App\Models\EventsUsersRegistrations;
use App\Models\EventsSectionsRegistrations;
use App\Models\Setting;
use Carbon\Carbon;
use Config;

class EventsUsersRegistrationsController extends Controller
{
	protected $UserStatus = [
		-1 => 'Отклонена',
		0 => 'Не обработана',
		1 => 'Подтверждена',
	];
	protected $MonthInYears = [
		'M' => [
			'01' => 'Январь',
			'02' => 'Февраль',
			'03' => 'Март',
			'04' => 'Апрель',
			'05' => 'Май',
			'06' => 'Июнь',
			'07' => 'Июль',
			'08' => 'Август',
			'09' => 'Сентябрь',
			'10' => 'Октябрь',
			'11' => 'Ноябрь',
			'12' => 'Декабрь',
		],
		'm' => [
			'01' => 'января',
			'02' => 'февраля',
			'03' => 'марта',
			'04' => 'апреля',
			'05' => 'мая',
			'06' => 'июня',
			'07' => 'июля',
			'08' => 'августа',
			'09' => 'сентября',
			'10' => 'октября',
			'11' => 'ноября',
			'12' => 'декабря',
		],
		's' => [
			'01' => 'янв',
			'02' => 'фев',
			'03' => 'мар',
			'04' => 'апр',
			'05' => 'мая',
			'06' => 'июн',
			'07' => 'июл',
			'08' => 'авг',
			'09' => 'сен',
			'10' => 'окт',
			'11' => 'ноя',
			'12' => 'дек',
		],
	];
	
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
    public function index()
    {
		$EventsUsersRegistrations = EventsUsersRegistrations::where('event_id',$event_id)->orderBy('created_at')->get();				
		
		//dd($UsersRegistrations);
		
		/*$managers->role_id_modules = $roles->filter(function($item) {
			return $item->id == 5;
		})->first();*/

		return view('admin/events/users_registrations')->with([
			'EventsUsersRegistrations'=>$EventsUsersRegistrations,
		]);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {		
		$manager = new User;		
		$roles = Roles::orderBy('id')->get();
		
		return view('admin/managers/manager')->with([
			'manager'=>$manager,
			'roles'=>$roles,
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
    	//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $UsersRegistrations = EventsUsersRegistrations::where('event_id',$event_id)->orderBy('created_at')->get();				

		return view('admin/events/users_registrations')->with([
			'UsersRegistrations'=>$UsersRegistrations,
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $user_reg_info = EventsUsersRegistrations::find($id);
		
		$is_event_reg = EventsSections::where('event_id',$user_reg_info->event_id)->get();
		$is_event_reg_sections = EventsSectionsRegistrations::where('event_id',$user_reg_info->event_id)->where('user_id',$user_reg_info->user_id)->get();

		return view('admin/events/user_registrations')->with([
			'user_reg_info'=>$user_reg_info,
			'MonthInYears'=>$this->MonthInYears,
			'UserStatus'=>$this->UserStatus,		
			'is_event_reg'=>$is_event_reg,		
			'is_event_reg_sections'=>$is_event_reg_sections,		
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
			$user = User::find($id);
			
			if(isset($request->active)){
				$user->active 		= ($request->active ? $request->active : 0);
			}
			
			$user->save();
			
			if(isset($request->active)){	
				return "ajax_update_active";
			}
		} else { #Обычное сохранение
			
			$user_reg_info = EventsUsersRegistrations::find($id);
			
			if(isset($request->delete_event)){
				EventsSectionsRegistrations::where('event_id',$user_reg_info->event_id)->where('user_id',$user_reg_info->user_id)->delete();
				EventsUsersRegistrations::where('id', '=', $id)->delete();
				return redirect('admin/events/reg/'.$request->event_id);
			}
			
			$user = User::find($user_reg_info->user_id);	
			
			$user_registrations_on_event_confirm_send = '';
			if(isset($request->change_status_1) || isset($request->change_status_1_re)){
				$user_reg_info->status 	= 1;
				$user_reg_info->save();
				$messages_save = 'Статус заявки изменен.';
				
				# Отправляем пользователю письмо о подтверждении
				$url_to_events = '';
				if(!empty($user_reg_info->details_event->event_online_url)){
					$url_to_events = $user_reg_info->details_event->event_online_url;
				}
				$event_url = Config::get('cms.sites.'.$this->mode().'.site_url').'events/'.$user_reg_info->details_event->url;
				$mail_text = $user_reg_info->details_event->user_registrations_on_event_confirm;
				if(empty($mail_text)){
					$setting = Setting::where('code','user_registrations_on_event_confirm')->first();
					$mail_text = $setting->val;
				}
				$feedback = (object) array(
					'event_url' => $event_url,					
					'event_name' => $user_reg_info->details_events->name,					
					'url_to_events' => $url_to_events,					
					'mail_text' => $mail_text,					
				);
				$subject = 'Регистрация на мероприятие на сайте '.Config::get('cms.sites.'.$this->mode().'.site_name');
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$user->email,
					$feedback,
					$subject, 
					'user_registrations_on_event_confirm'
				);
				$user_registrations_on_event_confirm_send = 'Письмо о подтверждении выслано пользователю на почту.';
				
				return redirect()->route('users_registrations.edit', [$user_reg_info->id])
					->with('messages_save',$messages_save)
					->with('user_registrations_on_event_confirm_send',$user_registrations_on_event_confirm_send);
			}
			if(isset($request->change_status_m1)){
				$user_reg_info->status 	= -1;
				$user_reg_info->save();
				$messages_save = 'Статус заявки изменен.';
				
				# Отправляем пользователю письмо о неподтверждении
				$event_url = Config::get('cms.sites.'.$this->mode().'.site_url').'events/'.$user_reg_info->details_event->url;
				$feedback = (object) array(
					'event_url' => $event_url,					
					'event_name' => $user_reg_info->details_events->name,					
				);
				$subject = 'Регистрация на мероприятие на сайте '.Config::get('cms.sites.'.$this->mode().'.site_name');
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$user->email,
					$feedback,
					$subject, 
					'user_registrations_on_event_confirm_no'
				);
				$user_registrations_on_event_confirm_send = 'Письмо о неподтверждении выслано пользователю на почту.';
				
				return redirect()->route('users_registrations.edit', [$user_reg_info->id])
					->with('messages_save',$messages_save)
					->with('user_registrations_on_event_confirm_send',$user_registrations_on_event_confirm_send);;
			}
			
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
        //User::where('id', '=', $id)->delete();
        
        //return redirect()->route('managers.index');
    }
}
