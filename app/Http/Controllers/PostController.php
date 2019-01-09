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
    protected $answerRepository;
    protected $tagRepository;
    protected $userRepository;
    protected $report;

    public function __construct(
        PostRepositoryInterface $postRepository,
        AnswerRepositoryInterface $answerRepository,
        TagRepositoryInterface $tagRepository,
        UserRepositoryInterface $userRepository,
        Report $report
    ) {
        $this->postRepository = $postRepository;
        $this->answerRepository = $answerRepository;
        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
        $this->report = $report;
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

    public function all(Request $request)
    {
        $input = $request->all();
        $allPosts = $this->postRepository->getPostWithUserPaginate($input);
        $trendingPost = $this->postRepository->gettrendingPostLimit(10);
        $ownTags = '';

        if (Auth::check()) {
            $ownTags = $this->postRepository->getOwnTags();
        }

        return view('home.post.all', compact('allPosts', 'input', 'trendingPost', 'ownTags'));
    }

    public function detail($id)
    {
        $this->postRepository->increaseViewTotal($id);
        $post = $this->postRepository->findPostWithUser($id);

        if (empty($post)) {
            return redirect()->route('home.post.index');
        }
        $postReplies = $this->postRepository->getRepliesFromPost($post);
        $postVote = $this->postRepository->findVoteFromPost($post);
        //get answer from post id
        $answers = $this->answerRepository->getAnswerFromPost($id);
        $answersReplies = $this->answerRepository->getRepliesFromAnswers($answers);
        $answersVotes = $this->answerRepository->getVotesFromAnswers($answers);
        $relatedPost = $this->postRepository->getRelatedPost($post->tags, $id);

        if (!empty($post)) {
            return view(
                'home.post.detail',
                compact('post', 'postReplies', 'postVote', 'answers', 'answersReplies', 'answersVotes', 'relatedPost')
            );
        } else {
            return view('home.post.index');
        }
    }
}
