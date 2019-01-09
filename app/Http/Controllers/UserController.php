<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\EditImageRequest;
use App\Http\Requests\EditPasswordRequest;
use App\User;
use Auth;
use Config;
use Hash;
use Session;

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
        $allUsers = $this->userRepository->paginate();

        return view('home.user.index', compact('allUsers'));
    }

    public function postIndex(Request $request)
    {
        $input = $request->all();
        $allUsers = $this->userRepository->filter($input);
        $response = [
            'pagination' => [
                'total' => $allUsers->total(),
                'per_page' => $allUsers->perPage(),
                'current_page' => $allUsers->currentPage(),
                'last_page' => $allUsers->lastPage(),
                'from' => $allUsers->firstItem(),
                'to' => $allUsers->lastItem(),
            ],
            'data' => $allUsers,
        ];

        return response()->json($response);
    }

    public function detail($id)
    {
        $user = $this->userRepository->find($id);

        if (!empty($user)) {
            return view('home.user.detail', compact('activePage', 'user', 'id'));
        } else {
            return view('home.index');
        }
    }

    public function activity($id)
    {
        if (!empty($id)) {
            return view('home.user.activity', compact('activePage', 'id'));
        }

        return view('home.index');
    }

    public function setting()
    {
        $currentUser = Auth::user();

        return view('home.user.setting', compact('currentUser'));
    }

    public function password()
    {
        $currentUser = Auth::user();

        return view('home.user.password', compact('currentUser'));
    }

    // request edit profile
    public function editProfile(EditProfileRequest $request)
    {
        $input = $request->all();
        $currentUser = Auth::user();

        if (!empty($input)) {
            if ($this->userRepository->update($input, $currentUser->id)) {
                return redirect()->route('home.user.setting');
            } else {
                return redirect()->route('home.user.setting')->withErrors(['errorUpdate' => __('alert.error.update')]);
            }
        }
    }

    //request edit avatar
    public function editImage(EditImageRequest $request)
    {
        $input = $request->all();
        $currentUser = Auth::user();

        if (!empty($input)) {
            // name for image file
            $fileName1 = $input['image']->getClientOriginalName();
            $fileName2 = md5($currentUser->id . '_' . $fileName1) . '.' . $input['image']->getClientOriginalExtension();
            $input['image_path'] = $fileName2;

            if ($this->userRepository->update($input, $currentUser->id)) {
                // move file to uploads folder
                $input['image']->move(Config::get('constants.IMAGE_UPLOAD_PATH'), $fileName2);
                Session::flash('success_alert', __('alert.success.update'));

                return redirect()->route('home.user.setting');
            } else {
                return redirect()->route('home.user.setting')->withErrors(['errorUpdate' => __('alert.error.update')]);
            }
        }
    }

    // request change password
    public function editPassword(EditPasswordRequest $request)
    {
        $input = $request->all();
        $currentUser = Auth::user();

        if (!empty($input)) {
            $currentPassword = $currentUser->password;
            // check correct old password
            if (Hash::check($input['oldPassword'], $currentPassword)) {
                $input['password'] = Hash::make($input['password']);

                if ($this->userRepository->update($input, $currentUser->id)) {
                    //set new password to Auth
                    $currentUser['password'] = $input['password'];
                    Auth::setUser($currentUser);
                    Session::flash('success_alert', __('alert.success.update'));

                    return redirect()->route('home.user.password');
                } else {
                    return redirect()->route('home.user.password')
                        ->withErrors(['errorUpdate' => __('alert.error.update')]);
                }
            } else {
                return redirect()->route('home.user.password')
                ->withErrors(['oldPassword' => __('alert.error.oldPassword')]);
            }
        }
    }
}
