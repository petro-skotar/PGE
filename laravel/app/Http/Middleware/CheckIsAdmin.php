<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role != 'admin'){ 
            return redirect()->route('dashboard');
        }
        if(Auth::user()->active == 0){ 
			Session::flush();
			Auth::logout();
			return redirect()->route('login')
				->with('date_errors',__('auth.no_active'));
        }
		
		$path = request()->path();
		$mas_m = explode('/',request()->path());
		
		//if(Auth::user()->roles_open_modules()){}
				
		if(!empty($mas_m[1])){
			$need_module = $mas_m[1];
			$M = Auth::user()->roles_modules;
			$M = $M->keyBy('module');
			if($M->has($need_module)){
				//dd($M[0]);
			} else {
				if(in_array(Auth::user()->role_id, [8]) && !empty(Auth::user()->aml_artile_id)){ # Участник МСИ
					return redirect()->route('uchastniki-aml.edit', Auth::user()->aml_artile_id);
				}
				if(in_array(Auth::user()->role_id, [6]) && !empty(Auth::user()->pfr_artile_id)){ # Сотрудники ПФР
					return redirect()->route('uchastniki-pfr.edit', Auth::user()->pfr_artile_id);
				}
				//dd(Auth::user()->getFirstRolesModules(Auth::user()->role_id)->module);
				//dd('доступ к модулю '.$need_module.' запрещен',$M);
			}
		}
        
        return $next($request);
    }
}
