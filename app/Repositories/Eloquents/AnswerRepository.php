<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Answer;

class AnswerRepository implements AnswerRepositoryInterface
{
    /**
     * Specify Model class name
     */
    public function model()
    {
        return new Answer;
    }

    public function user()
    {
        return $this->model()->with('user');
    }

    /**
     * Retrieve all data of repository
     */
    public function all($columns = ['*'])
    {
        return $this->model()->all();
    }

    public function getAnswerFromPost($id)
    {
        return $this->model()->with('user')->where('post_id', $id)->get();
    }

    public function getRepliesFromAnswers($answers)
    {
        $answersReplies = [];

        foreach ($answers as $key => $ans) {
            $answersReplies[$key] = $ans->replies()->with('user')->get();
        }

        return $answersReplies;
    }

    public function getVotesFromAnswers($answers)
    {
        $answersVotes = [];

        foreach ($answers as $key => $ans) {
            $answersVotes[$key] = $ans->votes()->where(['voteable_id' => $ans->id, 'user_id' => \Auth::id()])->first();
        }

        return $answersVotes;
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model()->paginate($limit, $columns);
    }
    /**
     * Find data by id
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model()->findOrFail($id, $columns);
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
}
