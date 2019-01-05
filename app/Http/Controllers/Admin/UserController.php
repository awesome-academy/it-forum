<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
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

    public function create()
    {
        return view('admin.user.create');
    }

    public function add(AddUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['image_path'] = config('constants.IMAGE_UPLOAD_PATH') . config('constants.DEFAULT_USER_IMAGE');
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        if ($this->userRepository->create($input)) {
            \Session::flash('success_alert', __('admin.alert.successAdd'));

            return redirect()->route('admin.user.create');
        }
    }

    public function delete($id)
    {
        $this->userRepository->delete($id);

        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(EditUserRequest $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        $this->userRepository->update($input, $request->id);

        return redirect()->route('admin.user.index');
    }
}
