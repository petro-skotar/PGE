<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisuallyImpaireds;

class VisuallyImpairedsController extends Controller
{
	
	# Изменение режима для слабовидящих
	public function visually_impaireds_change(Request $request){
		
		if(session()->has('VISUALLYIMPAIREDS')){
			session()->forget('VISUALLYIMPAIREDS');
		} else {
			session()->put('VISUALLYIMPAIREDS','VISUALLYIMPAIREDS');
		}
		session()->save();
		return redirect()->route('index');
	}
	
	# Получание IP
	public function get_ip_temp(Request $request){
		return "
			LARAVEL: <br>
			Ip: ".$request->ip()."<br>
			ClientIp: ".$request->getClientIp()."<br><br>
			PHP:<br>
			SERVER['REMOTE_ADDR']: ".$_SERVER['REMOTE_ADDR']."<br>
		";
	}
	
	
}
