<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function sitemap()
    {
		/*$offers 	= 	app(ArticlesController::class)->getOffers();
		$industries = 	app(ArticlesController::class)->getIndustries();*/
		$blog = 		app(ArticlesController::class)->getBlog();
		
		return response()->view('seo.sitemap', [
			/*'offers' => $offers,
			'industries' => $industries,*/
			'blog' => $blog,
		])->header('Content-Type', 'text/xml');
    }
	
    public function robots_txt(Request $request)
    {

$robots_text ='User-agent: *
Disallow: /templates/
Disallow: /livewire/
Disallow: /login
Disallow: /?tag';
		
		return response()->view('seo.robots_txt', [
			'robots_text' => $robots_text,
		])->header('Content-Type', 'text/plain');
    }
}
