<?php

namespace App\Repositories\Task;

use App\Repositories\EloquentRepository;

class TaskRepository extends EloquentRepository implements TaskRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Task::class;
    }
}
