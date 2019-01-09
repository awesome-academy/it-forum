<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ConfigRepositoryInterface;
use App\Http\Requests\AddConfigRequest;
use App\Http\Requests\EditConfigRequest;
use App\Config;
use Input;
use Auth;

class ConfigController extends Controller
{
    protected $configRepository;

    public function __construct(ConfigRepositoryInterface $configRepository)
    {
        $this->configRepository = $configRepository;
    }
    
    public function index()
    {
        $configs = $this->configRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));

        return view('admin.config.index', compact('configs'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $configs = $this->checkSearchValue($request->search);

            return view('admin.layout.configtable', compact('configs'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $configs = $this->configRepository->findByKey('name', $key)
                ->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        } else {
            return $configs = $this->configRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }

    public function create()
    {
        return view('admin.config.create');
    }

    public function add(AddConfigRequest $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        if ($this->configRepository->create($input)) {
            \Session::flash('success_alert', __('admin.alert.successAdd'));

            return redirect()->route('admin.config.create');
        }
    }

    public function delete($id)
    {
        $this->configRepository->delete($id);

        return redirect()->route('admin.config.index');
    }

    public function edit($id)
    {
        $config = $this->configRepository->find($id);
        
        return view('admin.config.edit', compact('config'));
    }

    public function update(EditConfigRequest $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        $this->configRepository->update($input, $request->id);

        return redirect()->route('admin.config.index');
    }
}
