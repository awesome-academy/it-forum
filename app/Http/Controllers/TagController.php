<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Follow;
use Auth;

class TagController extends Controller
{

    protected $tagRepository;
    protected $follow;

    public function __construct(TagRepositoryInterface $tagRepository, Follow $follow)
    {
        $this->tagRepository = $tagRepository;
        $this->follow = $follow;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $allTags = $this->tagRepository->getTagsWithPaginate($input);

        return view('home.tag.index', compact('allTags', 'input'));
    }

    public function postIndex(Request $request)
    {
        $input = $request->all();
        $allTags = $this->tagRepository->getTagsWithPaginate($input);
        $response = [
            'pagination' => [
                'total' => $allTags->total(),
                'per_page' => $allTags->perPage(),
                'current_page' => $allTags->currentPage(),
                'last_page' => $allTags->lastPage(),
                'from' => $allTags->firstItem(),
                'to' => $allTags->lastItem(),
            ],
            'data' => $allTags,
        ];

        return response()->json($response);
    }

    public function detail(Request $request, $tagName)
    {
        $input = $request->all();

        if (!empty($tagName)) {
            $input['tagName'] = $tagName;
            $allPosts = $this->tagRepository->getPostsbyTagName($input);
            $relatedTags = $this->tagRepository->getRelatedTags($tagName);
            $tag = $this->tagRepository->findByName($tagName);
            $checkF = '';

            if (Auth::check()) {
                $currentId = Auth::id();
                $checkF = $this->follow->checkFollowTag($currentId, $tag->id);
            }

            if ($allPosts === false) {
                return redirect()->route('home.index');
            }

            return view('home.tag.detail', compact('allPosts', 'input', 'tagName', 'relatedTags', 'checkF', 'tag'));
        }

        return redirect()->route('home.index');
    }

    public function info($tagName)
    {
        $tag = $this->tagRepository->findByName($tagName);

        if (!empty($tag)) {
            $relatedTags = $this->tagRepository->getRelatedTags($tagName);

            return view('home.tag.info', compact('tag', 'tagName', 'relatedTags'));
        }

        return redirect()->route('home.index');
    }
}
