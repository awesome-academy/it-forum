<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Input;
use Auth;
use Config;

class UserController extends Controller
{
    /**
     * User controller
     * Author: Lampham
     */
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('home.user.index');
    }

    public function detail($id)
    {
        $user = $this->userRepository->find($id);

        if (!empty($user)) {
            return view('home.user.detail', compact('user', 'id'));
        } else {
            return view('home.index');
        }
    }

    public function activity($id)
    {
        if (!empty($id)) {
            return view('home.user.activity', compact('id'));
        }

        return view('home.index');
    }
}
