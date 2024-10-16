<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FullChecks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
		$path = url()->current();
		$pathLowercase = strtolower($path);
		if ($path !== $pathLowercase) {
			//return redirect($pathLowercase)->send();
			return \Redirect::to($pathLowercase, 301); 
		}
		
		//return new RedirectResponse($redirection, 302, ['Vary' => 'Accept-Language']); 
		return $next($request);
    }
}
