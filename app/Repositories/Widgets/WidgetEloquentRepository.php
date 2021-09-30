<?php

namespace App\Repositories\Widgets;


use App\Models\Widget;
use App\Repositories\Eloquent\EloquentRepository;

class WidgetEloquentRepository extends EloquentRepository implements WidgetRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Widget::class;
    }
}
