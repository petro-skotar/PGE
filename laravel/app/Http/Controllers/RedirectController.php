<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function index()
    {          
        if (Auth::user()->role == 'admin') {            
            //return redirect('admin/articles');			
			return redirect('/admin/'.Auth::user()->roles_modules[0]['module']);
        } else {           
            return redirect('dashboard');
        }

    }
}
