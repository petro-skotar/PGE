<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TempController extends Controller
{
    
    public function index()
    {        						
		return view('admin/temp')->with([
			'title'=>"Раздел в разработке",			
			'message'=>"Зайдите чуть позже"			
		]);
		
    }
}
