<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Post controller
     * Author: Lampham
     */
    public function index()
    {
        return view('home.post.index');
    }
}
