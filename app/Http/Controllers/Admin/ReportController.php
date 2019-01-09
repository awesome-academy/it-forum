<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Report;
use Input;
use Auth;
use Config;

class ReportController extends Controller
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }
    
    public function index()
    {
        $reports = $this->reportRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));

        return view('admin.report.index', compact('reports'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $reports = $this->checkSearchValue($request->search);

            return view('admin.layout.reporttable', compact('reports'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $reports = $this->reportRepository->findByKey('title', $key);
        } else {
            return $reports = $this->reportRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }

    public function delete($id)
    {
        $this->reportRepository->delete($id);

        return redirect()->route('admin.report.index');
    }

    public function edit($id)
    {
        $report = $this->reportRepository->find($id);
        
        return view('admin.report.edit', compact('report', 'tags'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        $this->reportRepository->update($input, $request->id);

        return redirect()->route('admin.report.index');
    }
}
