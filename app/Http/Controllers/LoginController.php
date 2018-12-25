<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
	/**
     * Home controller
     * Author: Lampham
     */
    public function signup()
    {
        return view('home.account.signup');
    }

    public function login()
    {
        return view('home.account.login');
    }

    public function logout()
    {
    	Auth::logout();
        
    	return redirect()->route('home.index');
    }
}
