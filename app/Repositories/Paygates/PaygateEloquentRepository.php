<?php


namespace App\Repositories\Paygates;


use App\Models\Paygate;
use App\Repositories\Eloquent\EloquentRepository;

class PaygateEloquentRepository extends EloquentRepository implements PaygateRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return Paygate::class;
    }
}
