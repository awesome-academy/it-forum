<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;

class SearchController extends Controller
{
    protected $postRepository;
    protected $tagRepository;

    public function __construct(PostRepositoryInterface $postRepository, TagRepositoryInterface $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    public function search()
    {
        $input = \Input::only('q', 'tab');
        $allTags = $this->tagRepository->findByName($input['q']);

        if (!empty($allTags)) {
            $tagName = $input['q'];

            return redirect()->route('home.tag.detail', $tagName);
        } else {
            $filterPost = $input['q'];
            $allPosts = $this->postRepository->getPostWithUserPaginate($input);
            $trendingPost = $this->postRepository->gettrendingPostLimit();
            $ownTags = '';

            if (\Auth::check()) {
                $ownTags = $this->postRepository->getOwnTags();
            }

            return view('home.post.search', compact('allPosts', 'input', 'filterPost', 'trendingPost', 'ownTags'));
        }
    }
}
