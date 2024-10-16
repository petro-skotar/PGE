<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin404Controller extends Controller
{
    public function index()
    {        						
		
		return view('admin/404')->with([
			'title'=>"Ошибка 404",			
			'message'=>"Страница не существует, или вам закрыт доступ к этому разделу.",
		]);
		
    }
}
