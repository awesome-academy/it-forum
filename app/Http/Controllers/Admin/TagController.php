<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Http\Requests\AddTagRequest;
use App\Tag;
use Input;
use Auth;
use Config;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }
    
    public function index()
    {
        $tags = $this->tagRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        
        return view('admin.tag.index', compact('tags'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $tags = $this->checkSearchValue($request->search);

            return view('admin.layout.tagtable', compact('tags'));
        }
    }

    public function checkSearchValue($key)
    {
        if ($key != '') {
            return $tags = $this->tagRepository->findByKey('name', $key)
                ->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        } else {
            return $tags = $this->tagRepository->paginate(config('constants.PAGINATION_LIMIT_NUMBER'));
        }
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function add(AddTagRequest $request)
    {
        $input = $request->all();
        $input['image_path'] = config('constants.IMAGE_UPLOAD_PATH') . config('constants.DEFAULT_TAG_IMAGE');
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        if ($this->tagRepository->create($input)) {
            \Session::flash('success_alert', __('admin.alert.successAdd'));

            return redirect()->route('admin.tag.create');
        }
    }

    public function delete($id)
    {
        $this->tagRepository->delete($id);

        return redirect()->route('admin.tag.index');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);

        return view('admin.tag.edit', compact('tag'));
    }

    public function update(AddTagRequest $request)
    {
        $input = $request->all();
        if (!isset($input['status'])) {
            $input['status'] = 0;
        }
        $this->tagRepository->update($input, $request->id);

        return redirect()->route('admin.tag.index');
    }
}
