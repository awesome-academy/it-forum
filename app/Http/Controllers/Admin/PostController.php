<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Http\Requests\EditPostAdminRequest;
use App\Post;
use Input;
use Auth;
use Config;
use Session;

class PostController extends Controller
{
    protected $postRepository;
    protected $tagRepository;

    public function __construct(PostRepositoryInterface $postRepository, TagRepositoryInterface $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        $tags = $this->setTag($posts);
        $reports = $this->checkReport($posts);

        return view('admin.post.index', compact('posts', 'tags', 'reports'));
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
        $post = $this->postRepository->findPostWithTags($id);
        $post->content = $this->replaceIframeEmbedded($post->content); // <iframe> to <p>
        $tags = '';
        foreach ($post->tags as $key => $tag) {
            $tags .= $tag->name . ',';
        }
        $tags = trim($tags, ',');

        return view('admin.post.edit', compact('post', 'tags'));
    }

    public function update(EditPostAdminRequest $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        $input['tags'] = explode(',', $input['tags']);
        $input['content'] = $this->removeSpace($input['content']);
        $input['content'] = $this->insertIframeEmbedded($input['content']);
        if ($post = $this->postRepository->update($input, $request->id)) {
            if ($tagsId = $this->tagRepository->firstOrCreateMultiple($input['tags'])) {
                if ($this->postRepository->updatePostsTags($tagsId, $request->id)) {
                    Session::flash('success_alert', __('alert.success.update'));

                    return redirect()->route('admin.post.edit', $request->id);
                }
            }
        }

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

    public function checkReport($posts)
    {
        $reports = [];
        foreach ($posts as $post) {
            $tmp = $post->total_view / 20;
            if ($post->reports->count() > $tmp) {
                array_push($reports, 'true');
            } else {
                array_push($reports, 'false');
            }
        }

        return $reports;
    }
}
