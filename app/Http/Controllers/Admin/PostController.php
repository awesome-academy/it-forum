<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Http\Requests\EditPostAdminRequest;
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
        $tags = $this->setTag($posts);

        return view('admin.post.index', compact('posts', 'tags'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $posts = $this->checkSearchValue($request->search);
            $tags = $this->setTag($posts);

            return view('admin.layout.posttable', compact('posts', 'tags'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $posts = $this->postRepository->findByKey('title', $key)
                ->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        } else {
            return $posts = $this->postRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }

    public function delete($id)
    {
        $this->postRepository->delete($id);

        return redirect()->route('admin.post.index');
    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $tags = $this->getTag($post->tags);

        return view('admin.post.edit', compact('post', 'tags'));
    }

    public function update(EditPostAdminRequest $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        $this->postRepository->update($input, $request->id);

        return redirect()->route('admin.post.index');
    }

    public function getTag($tags)
    {
        $listTag = '';
        foreach ($tags as $tag) {
            $listTag .= $tag->name . ', ';
        }

        return rtrim($listTag, ', ');
    }

    public function setTag($posts)
    {
        $tags = [];
        foreach ($posts as $post) {
            array_push($tags, $this->getTag($post->tags));
        }

        return $tags;
    }
}
