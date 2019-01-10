<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface;
use Auth;

class HomeController extends Controller
{

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $allPosts = $this->postRepository->getPostWithUserLimit($input);
        $trendingPost = $this->postRepository->gettrendingPostLimit(10);
        $ownTags = '';

        if (Auth::check()) {
            $ownTags = $this->postRepository->getOwnTags();
        }

        return view('home.post.index', compact('allPosts', 'input', 'trendingPost', 'ownTags'));
    }

    public function test()
    {
        return view('index');
    }
}
