<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Post;
use Input;
use Auth;
use Config;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    
    public function index()
    {
        $posts = $this->postRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));

        return view('admin.post.index', compact('posts'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $posts = $this->checkSearchValue($request->search);

            return view('admin.layout.posttable', compact('posts'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $posts = $this->postRepository->findByKey('title', $key)->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        } else {
            return $posts = $this->postRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }
}