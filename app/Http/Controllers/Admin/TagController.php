<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Tag;
use Input;
use Auth;
use Config;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }
    
    public function index()
    {
        $tags = $this->tagRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        
        return view('admin.tag.index', compact('tags'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $tags = $this->checkSearchValue($request->search);

            return view('admin.layout.tagtable', compact('tags'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $tags = $this->tagRepository->findByKey('name', $key)->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        } else {
            return $tags = $this->tagRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }
}
