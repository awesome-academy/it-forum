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

    public function edit($id)
    {
        $post = $this->postRepository->findPostWithTags($id);
        $post->content = $this->replaceIframeEmbedded($post->content); // <iframe> to <p>
        $tags = '';

        foreach ($post->tags as $key => $tag) {
            $tags .= $tag->name . ',';
        }
        $tags = trim($tags, ',');

        return view('home.post.edit', compact('post', 'tags'));
    }

    public function postEdit(EditPostRequest $request, $id)
    {
        $input = $request->all();

        $input['tags'] = explode(',', $input['tags']);
        $input['content'] = $this->removeSpace($input['content']); // remove space thua
        $input['content'] = $this->insertIframeEmbedded($input['content']); // insert iframe tag

        if ($post = $this->postRepository->update($input, $id)) {
            if ($tagsId = $this->tagRepository->firstOrCreateMultiple($input['tags'])) {
                if ($this->postRepository->updatePostsTags($tagsId, $id)) {
                    Session::flash('success_alert', __('alert.success.update'));

                    return redirect()->route('home.post.detail', $id);
                }
            }
        }

        return redirect()->route('home.post.write');
    }

    public function write()
    {
        return view('home.post.write');
    }

    public function postWrite(WritePostRequest $request)
    {
        $input = $request->all();
        $input['tags'] = explode(',', $input['tags']);
        $input['user_id'] = Auth::id();
        $input['status'] = config('constants.DEFAULT_USER_STATUS');
        $input['content'] = $this->removeSpace($input['content']); // remove space thua
        $input['content'] = $this->insertIframeEmbedded($input['content']); // insert iframe tag

        if ($post = $this->postRepository->create($input)) {
            if ($tagsId = $this->tagRepository->firstOrCreateMultiple($input['tags'])) {
                if ($this->postRepository->createPostsTags($tagsId, $post->id)) {
                    Session::flash('success_alert', __('alert.success.create'));

                    return redirect()->route('home.post.detail', $post->id);
                }
            }
        }

        return redirect()->route('home.post.write');
    }

    public function postComment(Request $request)
    {
        $input = $request->all();
        $currentUser = Auth::user();

        if ($request->ajax() && !empty($input['target']) && !empty($input['post_id']) && Auth::check()) {
            $validator = \Validator::make(
                $input,
                ['content' => 'required|between:20,2000'],
                [
                    'between' => __(
                        'validation.between.string',
                        [
                            'attribute' => __('page.post.content'),
                            'min' => 20,
                            'max' => 2000,
                        ]
                    ),
                    'content.required' => __('validation.required', ['attribute' => __('page.post.content')]),
                ]
            );

            if ($validator->fails()) {
                return $this->returnResponse($validator->messages()->first('content'), 403);
            } else {
                $returnHTML = '';
                $input['user_id'] = $currentUser->id;
                $input['status'] = config('constants.DEFAULT_USER_STATUS');
                if ($input['target'] == 1) {
                    $postReply = $this->postRepository->createReplies($input);
                    $returnHTML = view('home.post.view.postReplyView', compact('postReply'))->render();
                } elseif ($input['target'] == 2) {
                    if (empty($input['answer_id'])) {
                        return $this->returnResponse('Error!!!', 403);
                    } else {
                        $answerReply = $this->answerRepository->createReplies($input);
                        $returnHTML = view('home.post.view.answerReplyView', compact('answerReply'))->render();
                    }
                } elseif ($input['target'] == 3) {
                    $input['content'] = $this->removeSpace($input['content']);
                    $input['content'] = $this->insertIframeEmbedded($input['content']);
                    $answer = $this->answerRepository->create($input);
                    $authorId = $this->postRepository->find($input['post_id'])->user_id;
                    $this->postRepository->increaseAnswerTotal($input['post_id']);
                    $returnHTML = view('home.post.view.answerView', compact('answer', 'input', 'authorId'))->render();
                } else {
                    return $this->returnResponse('Error!!!', 403);
                }

                return $this->returnResponse($returnHTML, 200);
            }
        } else {
            return $this->returnResponse(__('alert.error.needLogin'), 401);
        }
    }

    public function postVote(Request $request)
    {
        $input = $request->all();
        $currentUser = Auth::user();

        if ($request->ajax() && Auth::check()) {
            if (in_array($input['score'], ['-1', '0', '1'])) {
                $input['user_id'] = $currentUser->id;

                if (!empty($input['answer_id'])) {
                    if ($score = $this->answerRepository->createVote($input)) {
                        $chlech = $this->answerRepository->updateVoteTotal($input['answer_id'], $score);

                        return $this->returnResponse(['score' => $chlech], 200);
                    }
                } else {
                    if ($score = $this->postRepository->createVote($input)) {
                        $chlech = $this->postRepository->updateVoteTotal($input['post_id'], $score);

                        return $this->returnResponse(['score' => $chlech], 200);
                    }
                }
            } else {
                return $this->returnResponse('Loi.', 403);
            }
        } else {
            return $this->returnResponse(__('alert.error.needLogin'), 401);
        }
    }

    public function postBestAnswer(Request $request)
    {
        $input = $request->all();

        if ($request->ajax() && !empty($input['answer_id']) && !empty($input['post_id']) && Auth::check()) {
            $input['user_id'] = Auth::id();

            if ($result = $this->postRepository->voteBestAnswer($input)) {
                if ($result === config('constants.UNVOTED')) {
                    return $this->returnResponse(__('alert.success.unvote'), 202);
                }

                return $this->returnResponse(__('alert.success.vote'), 200);
            } else {
                return $this->returnResponse(__('alert.error.vote'), 401);
            }
        } else {
            return $this->returnResponse(__('alert.error.needLogin'), 401);
        }
    }

    public function postReport(Request $request)
    {
        $input = $request->all();

        if ($request->ajax() && !empty($input['post_id']) && Auth::check()) {
            $input['user_id'] = Auth::id();
            $input['comment'] = config('constants.REPORT_MESSAGES.' . $input['report'], null);
            $input['comment'] = $input['comment'] . '|||' . $input['note'];

            $validator = \Validator::make(
                $input,
                [
                    'note' => 'max:200',
                    'report' => 'required|numeric',
                ],
                [
                    'max' => __('validation.max.string', ['attribute' => __('page.post.note'), 'max' => 200]),
                    'report.required' => __('validation.required', ['attribute' => __('page.post.report')]),
                ]
            );

            if ($validator->fails()) {
                return $this->returnResponse($validator->messages(), 403);
            } else {
                if ($this->report->saveReport($input)) {
                    return $this->returnResponse(__('alert.success.report'), 200);
                } else {
                    return $this->returnResponse(__('alert.error.report'), 401);
                }
            }
        } else {
            return $this->returnResponse(__('alert.error.needLogin'), 401);
        }
    }

    public function returnResponse($content, $returnCode)
    {
        $data = [
            'returnCode' => $returnCode,
            'content' => $content,
        ];

        return response()->json($data);
    }

    // remove space in content
    public function removeSpace($input = '')
    {
        $pattern = '/&nbsp;/';
        $iframe = '';

        return preg_replace($pattern, $iframe, $input);
    }

    // insert code compile iframe
    public function insertIframeEmbedded($input = '')
    {
        $pattern = '/<p>{@embed:(.+?)}<\/p>/';
        $iframe = '<iframe src="$1" scrolling="no" class="iframe-embedded"></iframe>';

        return preg_replace($pattern, $iframe, $input);
    }

    public function replaceIframeEmbedded($input = '')
    {
        $pattern = '/<iframe src="(.+?)".+<\/iframe>/';
        $resu = '<p>{@embed:$1}</p>';

        return preg_replace($pattern, $resu, $input);
    }
}
