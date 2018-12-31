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
    protected $paginate = 10;
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
        $users = $this->userRepository->paginate($this->paginate);

        return view('admin.user.index', compact('users'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->checkSearchValue($request->search);
            if ($users) {
                $output = '';
                foreach ($users as $user) {
                    $output .= '<tr>
                        <td class="align-middle">' . htmlspecialchars($user->id) . '</td>
                        <td class="align-middle">' . htmlspecialchars($user->username) . '</td>
                        <td class="align-middle">' . htmlspecialchars($user->email) . '</td>
                        <td class="align-middle">' . htmlspecialchars($user->fullname) . '</td>
                        <td class="align-middle">' . htmlspecialchars($user->phone) . '</td>
                        <td class="align-middle">' . date('d/m/Y', strtotime($user->birthday)) . '</td>
                        <td class="align-middle">' . (($user->gender == 1) ? __('admin.male') : __('admin.female')) . '</td>
                        <td class="align-middle">' . htmlspecialchars($user->address) . '</td>
                        <td class="align-middle">' . htmlspecialchars(($user->role_id == 1) ? __('admin.admin') : __('admin.category.user')) . '</td>
                        <td class="align-middle">' . htmlspecialchars(($user->status == 1) ? __('admin.active') : __('admin.deactive')) . '</td>
                        <td class="align-middle">
                            <a class="btn btn-primary action" id="action">' .  __('admin.edit') . '</a>
                            <a class="btn btn-danger action" id="action">' .  __('admin.delete') . '</a>
                        </td>
                    </tr>';
                }

                return Response($output);
            }
        }
    }

    public function checkSearchValue($key){
        if ($key != '') {
            return $users = $this->userRepository->findByKey('username', $key)->paginate($this->paginate);
        } else {
            return $users = $this->userRepository->paginate($this->paginate);
        }
    }

    public function create(){
        return view('admin.user.create');
    }

    public function add(){

    }
}
