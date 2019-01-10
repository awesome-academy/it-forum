<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Report;
use Carbon\Carbon;

class ReportRepository implements ReportRepositoryInterface
{
    /**
     * Specify Model class name
     */
    public function model()
    {
        return new Report;
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
     * Retrieve all data of this month only
     */
    public function getDataMonth()
    {
        return $this->model()->where('created_at', '>=', Carbon::now()->startOfMonth())->get();
    }

    /**
     * Retrieve all data of this week only
     */
    public function getDataWeek()
    {
        return $this->model()->where('created_at', '>=', Carbon::now()->startOfWeek())->get();
    }

    /**
     * Retrieve all data between two days
     */
    public function getDataBetween($start, $end)
    {
        return $this->model()
        ->whereBetween('created_at', [date('Y-m-d', $start) . ' 00:00:00', date('Y-m-d', $end) . ' 23:59:59'])
        ->get();
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model()->with('post', 'user')->paginate($limit, $columns);
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
        return $this->model()->whereHas('post', function ($query) use ($field, $keyword) {
            $query->where($field, 'LIKE', '%' . $keyword . '%');
        })->get();
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
