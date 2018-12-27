<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Input;
use App\User;

class LoginController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return view('home.account.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::check()) {
            return redirect()->route('home.index');
        }
        $input = $request->all();

        if (!empty($input)) {

            if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
                \Session::flash('success_alert', __('alert.success.login'));

                return redirect()->route('home.index');
            } else {
                return redirect()->route('home.login')->withErrors(['incorrectInfo' => __('alert.error.login')]);
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home.index');
    }

    public function signup()
    {
        return view('home.account.signup');
    }

    public function postSignup(SignupRequest $request)
    {
        $input = $request->all();

        if (!empty($input)) {

            $input['password'] = bcrypt($input['password']);
            $input['fullname'] = 'your fullname';

            if ($this->userRepository->create($input)) {
                \Session::flash('success_alert', __('alert.success.login'));

                return redirect()->route('home.index');
            } else {
                return redirect()->route('home.signup')->withErrors(['incorrectInfo' => __('alert.error.signup')]);
            }
        }
    }
}
