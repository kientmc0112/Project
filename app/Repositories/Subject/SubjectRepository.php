<?php

namespace App\Repositories\Subject;

use App\Repositories\EloquentRepository;

class SubjectRepository extends EloquentRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Subject::class;
    }
}
