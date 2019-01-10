<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\TagRepositoryInterface;
use App\Tag;

class TagRepository implements TagRepositoryInterface
{
    /**
     * Specify Model class name
     */
    public function model()
    {
        return new Tag;
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
        return $this->model()->all();
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model()->with('posts')->paginate($limit, $columns);
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

    public function getTagsWithPaginate($input, $limit = null)
    {
        $limit = (is_null($limit)) ? config('constants.PAGINATION_LIMIT_TAG', 28) : $limit;
        $query = $this->model()->withCount('posts');

        return $this->search($query, $input, $limit);
    }

    public function findByName($name, $columns = ['*'])
    {
        return $this->model()->select($columns)->where('name', $name)->first();
    }

    public function getPostByTagName()
    {
        return $this->model()->select($columns)->where('name', $name)->first();
    }

    public function getRelatedTags($tagName, $columns = ['*'])
    {
        return $this->model()->select($columns)->where('name', 'like', '%' . $tagName . '%')->get();
    }

    public function firstOrCreateMultiple($tags)
    {
        $tagsId = [];

        foreach ($tags as $k => $t) {
            if ($tag = $this->model()->firstOrCreate(['name' => $t])) {
                $tagsId[] = $tag->id;
            } else {
                return false;
            }
        }

        return $tagsId;
    }

    // search treding, newest tag
    public function search($query, $input, $limit)
    {
        $appends = [];

        if (!empty($input)) {
            if (!empty($input['name'])) {
                $query = $query->where('name', 'like', '%' . $input['name'] . '%');
            }

            if (!empty($input['isPopular'])) {
                $query = $query->orderBy('posts_count', 'desc');
            } else {
                $query = $query->orderBy('created_at', 'desc');
            }
        }
        $query = $query->orderBy('posts_count', 'desc')->paginate($limit);

        return $query;
    }

    // search treding, week, month post
    public function searchPosts($query, $input, $limit = null)
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
                $query->whereBetween('posts.created_at', [$startWeek, $endWeek]);
            } elseif ($input['tab'] == 'month') {
                $query->whereBetween('posts.created_at', [$startMonth, $endMonth]);
            }
            $appends['tab'] = $input['tab'];
        } else {
            $query->orderBy('total_vote', 'desc');
        }
        $query = $query->orderBy('id', 'desc')->paginate($limit)->appends($appends);

        return $query;
    }

    // get post by tag name
    public function getPostsbyTagName($input, $limit = null)
    {
        $limit = (is_null($limit)) ? config('constants.PAGINATION_LIMIT_NUMBER', 16) : $limit;
        $query = $this->model()->with('posts')->where('name', $input['tagName'])->first();

        if (empty($query)) {
            return false;
        }
        $postQuery = $query->posts()->with('user');

        return $this->searchPosts($postQuery, $input, $limit);
    }
}
