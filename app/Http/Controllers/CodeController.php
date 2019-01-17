<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use Input;
use Session;
use Auth;

class CodeController extends Controller
{
    /**
     * View, create, execute code
     * Author: Lampham
     */
    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    public function index()
    {
        return view('home.code.index');
    }

    public function list()
    {
        $codes = $this->code->where('user_id', Auth::id())->get();

        return view('home.code.list', compact('codes'));
    }

    public function test()
    {
        return view('home.code.test');
    }

    public function create()
    {
        return view('home.code.create');
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        $userId = Auth::id();

        if (!empty($input)) {
            $input['codename'] = $this->randomStringGenerator(config('constants.RANDOM_NUMBER_NAME'));
            $input['isphp'] = !empty($input['isphp']) ? 1 : 0;
            $input['user_id'] = $userId;

            if ($this->code->saveCode($input)) {
                return redirect()->route('home.code.show', $input['codename']);
            } else {
                return redirect()->route('home.code.create');
            }
        }
    }

    public function embedded($codeName)
    {
        $code = $this->code->where('codename', $codeName)->first();

        if (!empty($code)) {
            $view = $code->isphp == 1 ? 'home.code.embedded.php' : 'home.code.embedded.html';

            return view($view, compact('code'));
        } else {
            return redirect()->route('home.code.index');
        }
    }

    public function show($codeName)
    {
        $code = $this->code->where('codename', $codeName)->first();

        if (!empty($code)) {
            $view = $code->isphp == 1 ? 'home.code.show.php' : 'home.code.show.html';

            return view($view, compact('code'));
        } else {
            return redirect()->route('home.code.create');
        }

        return view('code.show');
    }

    public function read(Request $request)
    {
        $input = $request->all();
        $currentUser = Auth::user();

        if ($request->ajax() && !empty($input)) {
            $code = $this->code->where('codename', $input['codeName'])->first();

            if (!empty($code)) {
                if (!empty($currentUser) && $currentUser->id == $code->user_id) {
                    $code->update($input);
                } else {
                    Session::flash('code', $input);
                }

                return json_encode(['returnCode' => 1]);
            }
        }

        return json_encode(['returnCode' => 0]);
    }

    public function execute($codeName)
    {
        $code = Code::where('codename', $codeName)->first();

        if (Session::has('code')) {
            $code = Session::get('code');
        }

        return view('home.code.execute', compact('code'));
    }

    public function randomStringGenerator($number = 10)
    {
        $random = substr(md5(mt_rand()), 0, $number);

        return $random;
    }
}
