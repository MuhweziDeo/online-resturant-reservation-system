<?php

namespace App\Http\API\Table;
use App\Interfaces\RepositoryInterface;
use App\Models\Table;
use Illuminate\Database\Eloquent\Model;

class TableRepository implements RepositoryInterface {
    public $model;

    public function __construct(Table $table)
    {
        $this->model = $table;
    }

    public function findAll()
    {
        return $this->model::all();
    }

    public function findById(int $id): ?Model
    {
        return $this->model::findOrFail($id);
    }

    public function findByKey($key, $value): ?Model
    {
        return $this->model::where($key, $value)->first();
    }
}
