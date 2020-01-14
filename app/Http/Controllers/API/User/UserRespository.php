<?php

namespace App\Http\API\User;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\RepositoryInterface;
use App\Models\User;

class UserRepository implements RepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
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
