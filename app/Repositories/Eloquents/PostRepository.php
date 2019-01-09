<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Post;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Specify Model class name
     */
    public function model()
    {
        return new Post;
    }
    /**
     */
    public function __construct()
    {
    }

    /**
     * Retrieve all data of repository
     */
    public function all($columns = ['*'])
    {
        return $this->model()->with('user', 'tags')->all();
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model()->with('user', 'tags')->paginate($limit, $columns);
    }
    /**
     * Find data by id
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model()->findOrFail($id, $columns);
    }

    /**
     * Find data by keyword
     */
    public function findByKey($field, $keyword)
    {
        return $this->model()->where($field, 'LIKE', '%' . $keyword . '%');
    }

    /**
     * Save a new entity in repository
     */
    public function create(array $input)
    {
        return $this->model()->create($input);
    }

    /**
     * Update a entity in repository by id
     */
    public function update(array $input, $id)
    {
        $model = $this->model()->findOrFail($id);
        $model->fill($input);
        $model->save();

        return $this;
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->model()->destroy($id);
    }

    // post index
    public function getPostWithUserLimit($input, $limit = null)
    {
        $limit = (is_null($limit)) ? config('constants.PAGINATION_LIMIT_NUMBER', 16) : $limit;
        $query = $this->model()->with('user')->with('tags');

        return $this->search($query, $input, $limit);
    }

    // get post with paginate at post all, search module
    public function getPostWithUserPaginate($input, $limit = null)
    {
        $limit = (is_null($limit)) ? config('constants.PAGINATION_LIMIT_NUMBER', 16) : $limit;
        $query = $this->model()->with('user')->with('tags');

        return $this->search($query, $input, $limit, true);
    }

    public function getTreadingPostLimit($limit = null)
    {
        $limit = (is_null($limit)) ? config('constants.PAGINATION_LIMIT_TREDINGPOST', 16) : $limit;
        $query = $this->model()->with('tags')->orderBy('total_view', 'desc')->orderBy('id', 'desc')
            ->take($limit)->get();

        return $query;
    }

    public function getOwnTags()
    {
        $limit = config('constants.PAGINATION_LIMIT_OWN_TAG', 16);
        $currentUserId = \Auth::id();
        $tags = $this->model()->select('id')->where('user_id', $currentUserId)->with('tags')->get()->pluck('tags');
        $ownTags = collect([]);

        foreach ($tags as $key => $value) {
            $ownTags = $ownTags->merge($value);
        }

        return $ownTags->unique('id')->take($limit);
    }

    // search treding, week, month post
    public function search($query, $input, $limit, $isPaginate = false)
    {
        $appends = [];
        $timeControl = new \Carbon\Carbon();

        $startWeek = $timeControl->startOfWeek()->toDateString();
        $endWeek = $timeControl->endOfWeek()->toDateString();
        $startMonth = $timeControl->startOfMonth()->toDateString();
        $endMonth = $timeControl->endOfMonth()->toDateString();
        // filter by tab
        if (!empty($input['tab'])) {
            if ($input['tab'] == 'treding') {
                $query->orderBy('total_view', 'desc');
            } elseif ($input['tab'] == 'week') {
                $query->whereBetween('created_at', [$startWeek, $endWeek]);
            } elseif ($input['tab'] == 'month') {
                $query->whereBetween('created_at', [$startMonth, $endMonth]);
            }
        } else {
            $query->orderBy('total_vote', 'desc');
        }

        if (!empty($input['q'])) {
            $query->where('title', 'like', '%' . $input['q'] . '%');
        }
        // is paginate?
        $query = $isPaginate == true ? $query->orderBy('id', 'desc')->paginate($limit)->appends($appends)
            : $query->orderBy('id', 'desc')->take($limit)->get();

        return $query;
    }
}
