<?php

namespace App\Repositories\Ratting;

use App\Models\Ratting;
use App\Repositories\Eloquent\EloquentRepository;

class RattingEloquentRepository extends EloquentRepository implements RattingRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Ratting::class;
    }
}
