<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function get(array $conditions = [], array $relations = [], array $orderBy = ['created_at' => 'asc'])
    {
        return $this->model->where($conditions)->with($relations)->orderBy(array_key_first($orderBy), $orderBy[array_key_first($orderBy)])->get();
    }

    public function pagination(int $results = 10, array $conditions = [], array $relations = [], array $orderBy = ['created_at' => 'asc'])
    {
        return $this->model->where($conditions)->with($relations)->orderBy(array_key_first($orderBy), $orderBy[array_key_first($orderBy)])->paginate($results);
    }

    public function find($id, array $conditions = [], array $relations = [])
    {
        return $this->model->where($conditions)->with($relations)->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model::create($data);
    }

    public function update(Model $model, array $data)
    {
        $model->update($data);
        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
        return $model;
    }

    public function count()
    {
        return $this->model::count();
    }
}