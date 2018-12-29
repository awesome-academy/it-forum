<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home.index');
    }

    public function listUser()
    {
        return view('admin.user.index');
    }
}
