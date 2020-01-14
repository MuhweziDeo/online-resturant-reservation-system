<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function findAll();

    public function findById(int $id): ?Model;

    public function findByKey($key, $value): ?Model;
}
