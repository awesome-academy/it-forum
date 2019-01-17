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

    public function createReplies(array $input)
    {
        $input['repliable_id'] = $input['answer_id'];
        $input['repliable_type'] = 'App\Answer';

        return $this->model()->find($input['answer_id'])->replies()->create($input);
    }

    public function createVote(array $input)
    {
        $data = [
            'user_id' => $input['user_id'],
            'voteable_id' => $input['answer_id'],
            'voteable_type' => 'App\Answer',
        ];
        $answer = $this->model()->find($input['answer_id'])->votes()->where('user_id', $input['user_id']);
        $oldScore = !empty($answer->first()->score) ? $answer->first()->score : 0;

        if ($score = $answer->updateOrCreate($data, ['score' => $input['score']])) {
            return ['oldScore' => $oldScore, 'newScore' => $score->score];
        } else {
            return false;
        }
    }

    public function updateVoteTotal($id, $score)
    {
        $temp = $score['newScore'] - $score['oldScore'];

        if ($temp > 0) {
            $this->model()->find($id)->increment('total_vote', $temp);
        } elseif ($temp < 0) {
            $this->model()->find($id)->decrement('total_vote', abs($temp));
        }

        return $temp;
    }

    public function recountDataAnswer()
    {
        $answers = $this->model()->with('votes')->get();
        foreach ($answers as $answer) {
            $totalVote = $answer->votes->sum('score');
            $answer->update(['total_vote' => $totalVote]);
        }
    }
}
