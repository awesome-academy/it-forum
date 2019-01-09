<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\WritePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Post;
use App\Report;
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
        $ownTags = '';

        if (Auth::check()) {
            $ownTags = $this->postRepository->getOwnTags();
        }

        return view('home.post.index', compact('allPosts', 'input', 'treadingPost', 'ownTags'));
    }

    public function all(Request $request)
    {
        $input = $request->all();
        $allPosts = $this->postRepository->getPostWithUserPaginate($input);
        $treadingPost = $this->postRepository->getTreadingPostLimit();
        $ownTags = '';

        if (Auth::check()) {
            $ownTags = $this->postRepository->getOwnTags();
        }

        return view('home.post.all', compact('allPosts', 'input', 'treadingPost', 'ownTags'));
    }

    public function detail()
    {
        return view('home.post.detail');
    }
}
