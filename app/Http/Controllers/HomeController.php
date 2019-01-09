<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Post controller
     * Author: Lampham
     */
    public function index()
    {
        return view('index');
    }
}
