<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    //Model class instances

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function show(int $id)
    {
        return $this->model->where('id', $id)->first();
    }
}