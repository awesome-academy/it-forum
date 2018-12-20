<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Post controller
     * Author: Lampham
     */
    public function index()
    {
    	return view('home.tag.index');
    }

    public function detail()
    {
    	return view('home.tag.detail');
    }
}
