<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
     * User controller
     * Author: Lampham
     */
    public function index()
    {
    	return view('home.user.index');
    }

    public function detail()
    {
    	return view('home.user.detail');
    }
}
