<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Input;
use Auth;
use Config;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userRepository->setFillable($fillable = [
            'username',
            'email',
            'email_verified_at',
            'password',
            'fullname',
            'image_path',
            'phone',
            'birthday',
            'gender',
            'address',
            'status',
            'role_id',
        ]);
    }
    
    public function index()
    {
        $users = $this->userRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));

        return view('admin.user.index', compact('users'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->checkSearchValue($request->search);

            return view('admin.layout.usertable', compact('users'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $users = $this->userRepository->findByKey('username', $key)->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        } else {
            return $users = $this->userRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }
}
