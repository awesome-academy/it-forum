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

    public function readPhp(Request $request)
    {
        $requestData = $request->all();

        if ($request->ajax()) {
            $codeInput = isset($requestData['codeInput']) ? $requestData['codeInput'] : '';
            $codeName = isset($requestData['codeName']) ? $requestData['codeName'] : '';

            //update code
            $code = Code::where('codename', $codeName)->first();

            if (!empty($code) && Auth::id() == $code->user_id) {
                $code->update(['php' => $codeInput]);
            }

            if (!preg_match('/^<\?php/', $codeInput)) {
                $codeInput = '<?php ' . $codeInput;
            }
            //writeFile and then execute it
            $this->writeFile(public_path() . config('constants.EXECUTE_PATH'), $codeInput);
            //curl to execute a php file
            $url = $this->getAllUrl() . config('constants.EXECUTE_PATH');
            $source = $this->curl($url);

            return json_encode(['returnCode' => 1, 'data' => $source]);
        } else {
            return json_encode(['returnCode' => 0, 'data' => 'Error execute!']);
        }
    }

    public function randomStringGenerator($number = 10)
    {
        $random = substr(md5(mt_rand()), 0, $number);

        return $random;
    }

    public function getAllUrl($useForwardedHost = false)
    {
        $s = $_SERVER;
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = ($useForwardedHost && isset($s['HTTP_X_FORWARDED_HOST']))
            ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;

        return $protocol . '://' . $host;
    }

    public function curl($url = '')
    {
        $source = '';
        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $source = curl_exec($ch);
            curl_close($ch);

            if (preg_match_all('/b>(.+?)</', $source, $match)) {
                if ($match[1][3] == ' on line ') {
                    $source = $match[1][0] . $match[1][1] . $match[1][3] . $match[1][4];
                }
            }
        } catch (Exception $excep) {
            //
        }

        return $source;
    }

    public function writeFile($url, $data)
    {
        $file = fopen($url, 'w');
        fwrite($file, $data);
        fclose($file);
    }
}
