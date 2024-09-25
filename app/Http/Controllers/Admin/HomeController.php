<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function home(){
    	return view('admin.dashboard');
    
    }
    public function showLoginForm(){
    	return view('admin.page.login');
    
    }
	public function showRegisterForm(){
	    return view('admin.page.register');
	}
	public function create(){
	    return view('admin.product.create');
	}
}
