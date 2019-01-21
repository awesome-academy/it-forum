<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Socialite;
use Auth;
use Session;

class SocialAuthController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('account.login');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $user = $this->userRepository->createOrGetUser($user, $provider);

        if (!$user['isExist']) {
            Auth::login($user['userData']);
            Session::flash('success_alert', __('alert.success.createSocialAccount'));

            return redirect()->route('home.user.setting', Auth::id());
        }
        Session::flash('success_alert', __('alert.error.accountExist'));

        return redirect()->route('password.request');
    }
}
