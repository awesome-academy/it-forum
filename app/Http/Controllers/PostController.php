<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Post controller
     * Author: Lampham
     */
    public function index()
    {
    	return view('home.post.index');
    }

    public function detail()
    {
    	return view('home.post.detail');
    }
}
