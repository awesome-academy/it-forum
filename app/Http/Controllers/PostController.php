<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Post;
use Auth;
use Session;

class PostController extends Controller
{
    /**
     * Post controller
     * Author: Lampham
     */
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $allPosts = $this->postRepository->getPostWithUserLimit($input);
        $treadingPost = $this->postRepository->getTreadingPostLimit();

        return view('home.post.index', compact('allPosts', 'input', 'treadingPost'));
    }

    public function all(Request $request)
    {
        $input = $request->all();
        $allPosts = $this->postRepository->getPostWithUserPaginate($input);
        $treadingPost = $this->postRepository->getTreadingPostLimit();

        return view('home.post.all', compact('allPosts', 'input', 'treadingPost'));
    }

    public function detail()
    {
        return view('home.post.detail');
    }
}
