<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;
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
                if (is_null(Auth::user()->email_verified_at)) {
                    Auth::logout();

                    return redirect()->route('home.login')->withErrors(['incorrectInfo' => __('alert.error.login')]);
                }
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
            $input['fullname'] = config('constants.DEFAULT_USER_FULLNAME');
            $input['gender'] = config('constants.DEFAULT_USER_GENDER');
            $input['image_path'] = config('constants.IMAGE_UPLOAD_PATH') . config('constants.DEFAULT_USER_IMAGE');
            $input['role_id'] = config('constants.DEFAULT_USER_ROLE_ID');
            $input['status'] = config('constants.DEFAULT_USER_STATUS');
            if ($user = $this->userRepository->create($input)) {
                event(new Registered($user));

                return view('home.account.verify', compact('user'));
            }

            return redirect()->route('home.signup')->withErrors(['incorrectInfo' => __('alert.error.signup')]);
        }
    }

    public function resend($id)
    {
        $user = $this->userRepository->find($id);
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home.index');
        }
        event(new Registered($user));
        \Session::flash('resent', __('alert.success.resendSuccess'));

        return view('home.account.verify', compact('user'));
    }

    public function verify($id)
    {
        $user = $this->userRepository->find($id);
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home.index');
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            \Session::flash('success_alert', __('alert.success.login'));
            Auth::guard()->login($user);
        }

        return redirect()->route('home.index');
    }
}
