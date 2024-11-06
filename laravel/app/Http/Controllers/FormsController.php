<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\Subscribe;
use Config;

class FormsController extends Controller
{
    public function forms(Request $request){

		if(isset($_POST["name"]) && $_POST["name"] == "" && !empty($request->firstName)){

			$feedback = (object) array(
				'firstName' => $request->firstName,
				'subject' => $request->subject,
			);
            $fio = $request->firstName;
			if(!empty($request->lastName)){
				$feedback->lastName = $request->lastName;
                $fio .= ' '.$request->lastName;
			}
            $email = '';
			if(!empty($request->email)){
				$feedback->email = $request->email;
                $email = $request->email;
			}
			if(!empty($request->phone)){
				$feedback->phone = $request->phone;
			}
			if(!empty($request->stanowisko)){
				$feedback->stanowisko = $request->stanowisko;
			}
			if(!empty($request->speed)){
				$feedback->speed = $request->speed;
			}
            $firma = '';
			if(!empty($request->firma)){
				$feedback->firma = $request->firma;
                $firma = $request->firma;
			}
			if(!empty($request->message)){
				$feedback->message = $request->message;
			}
			if(!empty($request->checkbox2)){
				$feedback->checkbox2 = $request->checkbox2;
			}
			if(!empty($request->checkbox3)){
				$feedback->checkbox3 = $request->checkbox3;
			}
			if(!empty($request->checkbox5)){
				$feedback->checkbox5 = $request->checkbox5;
			}
			if(!empty($request->add_check_1)){
				$feedback->add_check_1 = $request->add_check_1;
			}
			if(!empty($request->add_check_2)){
				$feedback->add_check_2 = $request->add_check_2;
			}
			if(!empty($request->add_check_3)){
				$feedback->add_check_3 = $request->add_check_3;
			}
            $subscribe_active = 0;
			if(!empty($request->add_check_4)){
				$feedback->add_check_4 = $request->add_check_4;
                $subscribe_active = 1;
			}
			if(!empty($request->add_check_5)){
				$feedback->add_check_5 = $request->add_check_5;
			}
			if(!empty($request->add_check_6)){
				$feedback->add_check_6 = $request->add_check_6;
			}

			if($request->hasFile('userfile')) {
				$feedback->files = '';
				foreach($request->file('userfile') as $file){
					$feedback->userfile = $file->store('forms','public');
					$feedback->files .= '<li><a href="'.asset('/storage/'.$feedback->userfile).'">'.$file->getClientOriginalName().'</a></li>';
				}
			}

			if(\App::isProduction()){
				$toEmails[] = DATA::setting('system_email');
                if(!empty(DATA::setting('trello_email'))){
				    $toEmails[] = DATA::setting('trello_email');
                }
			} else {
				$toEmails[] = Config::get('cms.sites.local.system_email');
			}
			//$toEmail = Config::get('cms.sites.local.system_email');
			foreach($toEmails as $toEmail){
				app('App\Http\Controllers\SendMailsController')->send_mailer(
					$toEmail,
					$feedback,
					$feedback->subject.' - '.date("Y-m-d H:i:s",time()),
					'email'
				);
			}

            # Подписка
            if(!empty($email)){
                $subscribe_update = Subscribe::where('email',$email)->first();
                if(!empty($subscribe_update)){
                    $subscribe_update->name = $fio;
                    $subscribe_update->city = $firma;
                    $subscribe_update->active = $subscribe_active;
                    $subscribe_update->save();
                } else {
                    $Subscribe = Subscribe::create([
                        'email' => $email,
                        'name' => $fio,
                        'city' => $firma,
                        'active' => $subscribe_active,
                    ]);
                }
            }

			return 'send';
		} else {
			return 'error';
		}
	}
}
